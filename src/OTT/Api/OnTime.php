<?php

namespace OTT\Api;

use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Message\Response;
use OTT\Api\Connection\ConnectionAbstract;
use OTT\Api\Connection\ConnectionFactory;
use OTT\Api\Connection\ConnectionRequest;
use OTT\Api\Exception\ExceptionAbstract;
use OTT\Api\Filter\Attachments as AttachmentsFilter;
use OTT\Api\Filter\Contacts as ContactsFilter;
use OTT\Api\Filter\Customers as CustomersFilter;
use OTT\Api\Filter\Defects as DefectsFilter;
use OTT\Api\Filter\Features as FeaturesFilter;
use OTT\Api\Filter\Incidents as IncidentsFilter;
use OTT\Api\Filter\Filters as FiltersFilter;
use OTT\Api\Filter\ItemAbstract;
use OTT\Api\Filter\Projects as ProjectsFilter;
use OTT\Api\Filter\Releases as ReleasesFilter;
use OTT\Api\Filter\Tasks as TasksFilter;
use OTT\Api\Filter\Teams as TeamsFilter;
use OTT\Api\Filter\Users as UsersFilter;
use OTT\Api\Exception\ApiResultException;

/**
 * Class OnTime
 * @package OTT\Api
 */
class OnTime
{
    /** @var ConnectionAbstract */
    protected $connection;
    /** @var array */
    protected $main_parameters = [];
    /** @var array */
    protected $secondary_parameters = [];

    /**
     * @param ConnectionRequest $request
     * @throws Exception\ConnectionException
     */
    public function __construct(ConnectionRequest $request)
    {
        $this->setConnection(ConnectionFactory::getConnection($request));
        if ((null === $request->getSavedToken()) && (null === $this->getConnection()->getToken())) {
            $this->getConnection()->requestToken();
        } else {
            $this->getConnection()->setToken($request->getSavedToken());
        }
    }

    /**
     * @param $action
     * @param null $postMainParameters
     * @return Response|null
     * @throws Exception\ConnectionException
     */
    private function call($action, $postMainParameters = null)
    {
        $response = null;
        try {
            $url = $action .
                '/' .
                implode('/', $this->getMainParameters()) .
                ($postMainParameters === null ? null : '/' . $postMainParameters);
            /** @var Response $response */
            $response = $this->getConnection()->getHttpClient()->get(
                $url,
                ['query' => $this->getSecondaryParameters()]
            );
            error_log('Called URL : ' . $response->getEffectiveUrl());
        } catch (BadResponseException $e) {
            $error = $e->getResponse()->json();
            if (isset($error['error']) && $error['error'] === 'invalid_token') {
                $this->getConnection()->requestToken();
                $response = $this->call($action, $postMainParameters);
            } elseif (in_array($e->getResponse()->getStatusCode(), [404])) {
                $response = null;
            } elseif (isset($error['error_description'])) {
                $response['error'] = $e->getResponse()->json();
            }
            error_log(
                'Error while trying to reach API with URL : ' .
                ExceptionAbstract::formatBadResponse($e)
            );
        }
        $this->setMainParameters([]);
        $this->setSecondaryParameters([]);

        return $response;
    }

    /**
     * @param $response
     * @return array|null|void
     */
    private function handleResponse($response)
    {
        if ($response instanceof Response && $response->getStatusCode() === 200) {
            $result = $response->json();
        } elseif (is_array($response) && count($response) > 0) {
            $result = $response;
        } else {
            $result = null;
        }
        error_log(print_r($result, true));

        return $result;
    }

    /**
     * @return array
     */
    public function getMainParameters()
    {
        return $this->main_parameters;
    }

    /**
     * @param array $mainParameters
     */
    public function setMainParameters(array $mainParameters)
    {
        $this->main_parameters = $mainParameters;
    }

    /**
     * @param $mainParameter
     */
    public function addMainParameter($mainParameter)
    {
        if (null !== $mainParameter) {
            $this->main_parameters[] = $mainParameter;
        }
    }

    /**
     * @param $key
     * @return null
     */
    public function getSecondaryParameter($key)
    {
        return isset($this->secondary_parameters[$key]) ? $this->secondary_parameters[$key] : null;
    }

    /**
     * @return array
     */
    public function getSecondaryParameters()
    {
        $this->addSecondaryParameter('access_token', $this->getToken());
        return $this->secondary_parameters;
    }

    /**
     * @param array $secondaryParameters
     */
    public function setSecondaryParameters(array $secondaryParameters)
    {
        $this->secondary_parameters = $secondaryParameters;
    }

    /**
     * @param $key
     * @param $value
     */
    public function addSecondaryParameter($key, $value)
    {
        if (null !== $key && null !== $value) {
            if (is_bool($value)) {
                $value = $value ? 'true' : 'false';
            }
            $this->secondary_parameters[$key] = $value;
        }
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->getConnection()->getToken();
    }

    /**
     * @return ConnectionAbstract
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @param ConnectionAbstract $connection
     */
    public function setConnection($connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param  null|AttachmentsFilter $data
     * @return null|void
     */
    public function attachments($data = null)
    {
        $action = 'attachments';
        $postMainParameters = null;
        if ($data instanceof AttachmentsFilter) {
            $this->addMainParameter($data->getId());
            $this->addSecondaryParameter('format', $data->getFormat());
            $this->addSecondaryParameter('max_width', $data->getMaxWidth());
            $this->addSecondaryParameter('max_height', $data->getMaxHeight());
        } elseif (is_int($data)) {
            $this->addMainParameter($data);
        }
        $response = $this->call($action, $postMainParameters);
        $result = $this->handleResponse($response);

        return $result;
    }

    /**
     * @param  null|ContactsFilter $data
     * @return null|void
     */
    public function contacts($data = null)
    {
        $action = 'contacts';
        $postMainParameters = null;
        if ($data instanceof ContactsFilter) {
            $this->addMainParameter($data->getId());
            $this->addSecondaryParameter('search_string', $data->getSearchString());
            $this->addSecondaryParameter('search_field', $data->getSearchField());
            $this->addSecondaryParameter('customer_id', $data->getCustomerId());
            $this->addSecondaryParameter('page_size', $data->getPageSize());
            $this->addSecondaryParameter('page', $data->getPage());
            $this->addSecondaryParameter('sort_fields', $data->getSortFields());
            $this->addSecondaryParameter('columns', $data->getColumns());
            $this->addSecondaryParameter('group_field', $data->getGroupField());
            $this->addSecondaryParameter('extend', $data->getExtend());
        } elseif (is_int($data)) {
            $this->addMainParameter($data);
        }
        $response = $this->call($action, $postMainParameters);
        $result = $this->handleResponse($response);

        return $result;
    }

    /**
     * @param  null|CustomersFilter $data
     * @return null|void
     */
    public function customers($data = null)
    {
        $action = 'customers';
        $postMainParameters = null;
        if ($data instanceof CustomersFilter) {
            $this->addMainParameter($data->getId());
            $this->addSecondaryParameter('search_string', $data->getSearchString());
            $this->addSecondaryParameter('search_field', $data->getSearchField());
            $this->addSecondaryParameter('page_size', $data->getPageSize());
            $this->addSecondaryParameter('page', $data->getPage());
            $this->addSecondaryParameter('sort_fields', $data->getSortFields());
            $this->addSecondaryParameter('columns', $data->getColumns());
            $this->addSecondaryParameter('extend', $data->getExtend());
        } elseif (is_int($data)) {
            $this->addMainParameter($data);
        }
        $response = $this->call($action, $postMainParameters);
        $result = $this->handleResponse($response);

        return $result;
    }

    /**
     * @param  null|FiltersFilter $data
     * @return null|void
     */
    public function filters($data = null)
    {
        $action = 'filters';
        $postMainParameters = null;
        if ($data instanceof FiltersFilter) {
            $this->addSecondaryParameter('item_type', $data->getItemType());
        } elseif (is_int($data)) {
            $this->addMainParameter($data);
        }
        $response = $this->call($action, $postMainParameters);
        $result = $this->handleResponse($response);

        return $result;
    }

    /**
     * @param  null|ProjectsFilter $data
     * @return null|void
     */
    public function projects($data = null)
    {
        $action = 'projects';
        $postMainParameters = null;
        if ($data instanceof ProjectsFilter) {
            $this->addMainParameter($data->getId());
            $this->addSecondaryParameter('extend', $data->getExtend());
            if ($data->isWorkflow() && (null !== $data->getId())) {
                $postMainParameters = 'workflow';
                $this->addSecondaryParameter('item_type', $data->getItemType());
            } elseif ($data->isAttachments() && (null !== $data->getId())) {
                $postMainParameters = 'attachments';
            }
        } elseif (is_int($data)) {
            $this->addMainParameter($data);
        }
        $response = $this->call($action, $postMainParameters);
        $result = $this->handleResponse($response);

        return $result;
    }

    /**
     * @param  null|ReleasesFilter $data
     * @return null|void
     */
    public function releases($data = null)
    {
        $action = 'releases';
        $postMainParameters = null;
        if ($data instanceof ReleasesFilter) {
            $this->addMainParameter($data->getId());
            $this->addSecondaryParameter('filter_by_project_id', $data->getFilterByProjectId());
            $this->addSecondaryParameter('display_inactive', $data->isDisplayInactive());
        } elseif (is_int($data)) {
            $this->addMainParameter($data);
        }
        $response = $this->call($action, $postMainParameters);
        $result = $this->handleResponse($response);

        return $result;
    }

    /**
     * @param  null|TeamsFilter $data
     * @return null|void
     */
    public function teams($data = null)
    {
        $action = 'teams';
        $postMainParameters = null;
        if ($data instanceof TeamsFilter) {
            $this->addMainParameter($data->getId());
        } elseif (is_int($data)) {
            $this->addMainParameter($data);
        }
        $response = $this->call($action, $postMainParameters);
        $result = $this->handleResponse($response);

        return $result;
    }

    /**
     * @param  null|UsersFilter $data
     * @return null|void
     */
    public function users($data = null)
    {
        $action = 'users';
        $postMainParameters = null;
        if ($data instanceof UsersFilter) {
            $this->addMainParameter($data->getId());
            $this->addSecondaryParameter('search_string', $data->getSearchString());
            $this->addSecondaryParameter('include_inactive', $data->isIncludeInactive());
        } elseif (is_int($data)) {
            $this->addMainParameter($data);
        }
        $response = $this->call($action, $postMainParameters);
        $result = $this->handleResponse($response);

        return $result;
    }

    /**
     * @return array|null|void
     */
    public function me()
    {
        $action = 'me';
        $response = $this->call($action);
        $result = $this->handleResponse($response);

        return $result;
    }

    /**
     * Item objects factory
     * @param  null|ItemAbstract $data
     * @return null|string
     */
    private function item($data = null)
    {
        $postMainParameters = null;
        if ($data instanceof ItemAbstract) {
            $this->addMainParameter($data->getId());
            $this->addSecondaryParameter('project_id', $data->getProjectId());
            $this->addSecondaryParameter('release_id', $data->getReleaseId());
            $this->addSecondaryParameter('include_sub_projects_items', $data->isIncludeSubProjectsItems());
            $this->addSecondaryParameter('include_inactive_projects', $data->isIncludeInactiveProjects());
            $this->addSecondaryParameter('include_sub_releases_items', $data->isIncludeSubReleasesItems());
            $this->addSecondaryParameter('include_inactive_releases', $data->isIncludeInactiveReleases());
            $this->addSecondaryParameter('assigned_to_id', $data->getAssignedToId());
            $this->addSecondaryParameter('assigned_to_type', $data->getAssignedToType());
            $this->addSecondaryParameter('customer_id', $data->getCustomerId());
            $this->addSecondaryParameter('contact_id', $data->getContactId());
            $this->addSecondaryParameter('filter_id', $data->getFilterId());
            $this->addSecondaryParameter('include_archived', $data->isIncludeArchived());
            $this->addSecondaryParameter('page_size', $data->getPageSize());
            $this->addSecondaryParameter('search_string', $data->getSearchField());
            $this->addSecondaryParameter('search_field', $data->getSearchField());
            $this->addSecondaryParameter('page', $data->getPage());
            $this->addSecondaryParameter('sort_fields', $data->getSortFields());
            $this->addSecondaryParameter('columns', $data->getColumns());
            if ($data->isAttachments() && (null !== $data->getId())) {
                $postMainParameters = 'attachments';
            }
        } elseif (is_int($data)) {
            $this->addMainParameter($data);
        }

        return $postMainParameters;
    }

    /**
     * @param  null|DefectsFilter $data
     * @return null|void
     */
    public function defects($data = null)
    {
        $action = 'defects';
        $postMainParameters = $this->item($data);
        $response = $this->call($action, $postMainParameters);
        $result = $this->handleResponse($response);

        return $result;
    }

    /**
     * @param  null|FeaturesFilter $data
     * @return null|void
     */
    public function features($data = null)
    {
        $action = 'features';
        $postMainParameters = $this->item($data);
        $response = $this->call($action, $postMainParameters);
        $result = $this->handleResponse($response);

        return $result;
    }

    /**
     * @param  null|TasksFilter $data
     * @return null|void
     */
    public function tasks($data = null)
    {
        $action = 'tasks';
        $postMainParameters = $this->item($data);
        $response = $this->call($action, $postMainParameters);
        $result = $this->handleResponse($response);

        return $result;
    }

    /**
     * @param  null|IncidentsFilter $data
     * @return null|void
     */
    public function incidents($data = null)
    {
        $action = 'incidents';
        $postMainParameters = $this->item($data);
        $response = $this->call($action, $postMainParameters);
        $result = $this->handleResponse($response);

        return $result;
    }
}
