<?php

namespace Tests;

use OTT\Api\Connection\ConnectionRequest;
use OTT\Api\Filter\Attachments;
use OTT\Api\Filter\Contacts;
use OTT\Api\Filter\Customers;
use OTT\Api\Filter\Defects;
use OTT\Api\Filter\Features;
use OTT\Api\Filter\Filters;
use OTT\Api\Filter\Incidents;
use OTT\Api\Filter\Projects;
use OTT\Api\Filter\Releases;
use OTT\Api\Filter\Tasks;
use OTT\Api\Filter\Teams;
use OTT\Api\Filter\Users;
use OTT\Api\OnTime;

/**
 * Class OnTimeTest
 * @package Tests
 */
class OnTimeTest extends \PHPUnit_Framework_TestCase
{
    const NB_USERS = 25;

    /**
     *
     */
    public function testInitialization()
    {
        $resultT1 = new OnTime($this->getConfigOk());
        $this->assertInstanceOf('OTT\Api\Connection\ConnectionAbstract', $resultT1->getConnection());
        $this->assertInstanceOf('GuzzleHttp\Client', $resultT1->getConnection()->getHttpClient());
        $this->assertNotNull($resultT1->getToken());
        //
        $request = $this->getConfigOk();
        $request->setSavedToken($this->getTokenOk());
        $resultT2 = new OnTime($request);
        $this->assertEquals($this->getTokenOk(), $resultT2->getToken());
        //
        $this->setExpectedException('OTT\Api\Exception\ConnectionException');
        new OnTime(new ConnectionRequest());
        //
        $this->setExpectedException('OTT\Api\Exception\ConnectionException');
        new OnTime($this->getConfigKo());
    }

    /**
     *
     */
    public function testAttachments()
    {
        //
        $ot = $this->getOnTimeObjectOk();
        $resultT1 = $ot->attachments();
        $this->assertTrue(is_array($resultT1) && isset($resultT1['error']));
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT2 = new Attachments();
        $filterT2->setId(75);
        $resultT2 = $ot->attachments($filterT2);
        $this->assertTrue(is_array($resultT2['data']));
    }

    /**
     *
     */
    public function testContacts()
    {
        $ot = $this->getOnTimeObjectOk();
        $result = $ot->contacts();
        $this->assertTrue(is_array($result['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT1 = new Contacts();
        $resultT1 = $ot->contacts($filterT1);
        $this->assertTrue(is_array($resultT1['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT2 = new Contacts();
        $filterT2->setId(1);
        $resultT2 = $ot->contacts($filterT2);
        $this->assertTrue(is_array($resultT2['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT3 = new Contacts();
        $filterT3->setId(9999);
        $resultT3 = $ot->contacts($filterT3);
        $this->assertNull($resultT3['data']);
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT4 = new Contacts();
        $filterT4->setSearchString('h');
        $resultT4 = $ot->contacts($filterT4);
        $this->assertEquals(3, count($resultT4['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT5 = new Contacts();
        $filterT5->setSearchString('fail');
        $resultT5 = $ot->contacts($filterT5);
        $this->assertEquals(0, count($resultT5['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT6 = new Contacts();
        $filterT6->setCustomerId(1);
        $resultT6 = $ot->contacts($filterT6);
        $this->assertTrue(is_array($resultT6['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT7 = new Contacts();
        $filterT7->setCustomerId(9999);
        $resultT7 = $ot->contacts($filterT7);
        $this->assertTrue(is_array($resultT7['data']));
    }

    /**
     *
     */
    public function testCustomers()
    {
        $ot = $this->getOnTimeObjectOk();
        $result = $ot->customers();
        $this->assertTrue(is_array($result['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT1 = new Customers();
        $resultT1 = $ot->customers($filterT1);
        $this->assertTrue(is_array($resultT1['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT2 = new Customers();
        $filterT2->setId(1);
        $resultT2 = $ot->customers($filterT2);
        $this->assertTrue(is_array($resultT2['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT3 = new Customers();
        $filterT3->setId(9999);
        $resultT3 = $ot->customers($filterT3);
        $this->assertNull($resultT3['data']);
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT4 = new Customers();
        $filterT4->setSearchString('h');
        $resultT4 = $ot->customers($filterT4);
        $this->assertEquals(2, count($resultT4['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT5 = new Customers();
        $filterT5->setSearchString('fail');
        $resultT5 = $ot->customers($filterT5);
        $this->assertEquals(0, count($resultT5['data']));
    }

    /**
     *
     */
    public function testFilters()
    {
        $ot = $this->getOnTimeObjectOk();
        $resultT1 = $ot->filters();
        $this->assertTrue(is_array($resultT1['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT2 = new Filters();
        $filterT2->setItemType('defects');
        $resultT2 = $ot->filters($filterT2);
        $this->assertTrue(is_array($resultT2['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT3 = new Filters();
        $filterT3->setItemType('features');
        $resultT3 = $ot->filters($filterT3);
        $this->assertTrue(is_array($resultT3['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT4 = new Filters();
        $filterT4->setItemType('incidents');
        $resultT4 = $ot->filters($filterT4);
        $this->assertTrue(is_array($resultT4['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT5 = new Filters();
        $filterT5->setItemType('tasks');
        $resultT5 = $ot->filters($filterT5);
        $this->assertTrue(is_array($resultT5['data']));
    }

    /**
     *
     */
    public function testMe()
    {
        $ot = $this->getOnTimeObjectOk();
        $result = $ot->me();
        $this->assertTrue(is_array($result['data']));
    }

    /**
     *
     */
    public function testProjects()
    {
        $ot = $this->getOnTimeObjectOk();
        $resultT1 = $ot->projects();
        $this->assertTrue(is_array($resultT1['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT2 = new Projects();
        $resultT2 = $ot->projects($filterT2);
        $this->assertTrue(is_array($resultT2['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT3 = new Projects();
        $filterT3->setId(2);
        $resultT3 = $ot->projects($filterT3);
        $this->assertTrue(is_array($resultT3['data']));
    }

    /**
     *
     */
    public function testReleases()
    {
        $ot = $this->getOnTimeObjectOk();
        $resultT1 = $ot->releases();
        $this->assertTrue(is_array($resultT1['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT2 = new Releases();
        $resultT2 = $ot->releases($filterT2);
        $this->assertTrue(is_array($resultT2['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT3 = new Releases();
        $filterT3->setId(7);
        $resultT3 = $ot->releases($filterT3);
        $this->assertTrue(is_array($resultT3['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT4 = new Releases();
        $filterT4->setId(9999);
        $resultT4 = $ot->releases($filterT4);
        $this->assertNull($resultT4);
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT5 = new Releases();
        $filterT5->setDisplayInactive(true);
        $resultT5 = $ot->releases($filterT5);
        $this->assertTrue(is_array($resultT5['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT5 = new Releases();
        $filterT5->setFilterByProjectId(3);
        $resultT5 = $ot->releases($filterT5);
        $this->assertTrue(is_array($resultT5['data']));
    }

    /**
     *
     */
    public function testTeams()
    {
        $ot = $this->getOnTimeObjectOk();
        $resultT1 = $ot->teams();
        $this->assertTrue(is_array($resultT1['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT2 = new Teams();
        $resultT2 = $ot->teams($filterT2);
        $this->assertTrue(is_array($resultT2['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT3 = new Teams();
        $filterT3->setId(6);
        $resultT3 = $ot->teams($filterT3);
        $this->assertTrue(is_array($resultT3['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT4 = new Teams();
        $filterT4->setId(1);
        $resultT4 = $ot->teams($filterT4);
        $this->assertNull($resultT4);
    }

    /**
     *
     */
    public function testUsers()
    {
        //
        $ot = $this->getOnTimeObjectOk();
        $resultT1 = $ot->users();
        $this->assertTrue(is_array($resultT1['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $resultT2 = $ot->users(1);
        $this->assertTrue(is_array($resultT2['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $resultT3 = $ot->users(9999);
        $this->assertNull($resultT3['data']);
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT4 = new Users();
        $filterT4->setId(1);
        $resultT4 = $ot->users($filterT4);
        $this->assertTrue(is_array($resultT4['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT5 = new Users();
        $filterT5->setId(9999);
        $resultT5 = $ot->users($filterT5);
        $this->assertNull($resultT5['data']);
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT6 = new Users();
        $filterT6->setIncludeInactive(true);
        $resultT6 = $ot->users($filterT6);
        $this->assertTrue(is_array($resultT6['data']));
        $this->assertEquals(self::NB_USERS, count($resultT6['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT7 = new Users();
        $filterT7->setIncludeInactive(false);
        $resultT7 = $ot->users($filterT7);
        $this->assertTrue(is_array($resultT7['data']));
        $this->assertEquals(2, count($resultT7['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT8 = new Users();
        $filterT8->setIncludeInactive(null);
        $resultT8 = $ot->users($filterT8);
        $this->assertTrue(is_array($resultT8['data']));
        $this->assertEquals(self::NB_USERS, count($resultT8['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT9 = new Users();
        $resultT9 = $ot->users($filterT9);
        $this->assertTrue(is_array($resultT9['data']));
        $this->assertEquals(self::NB_USERS, count($resultT9['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT10 = new Users();
        $filterT10->setSearchString('mike');
        $resultT10 = $ot->users($filterT10);
        $this->assertTrue(is_array($resultT10['data']));
        $this->assertEquals(1, count($resultT10['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT11 = new Users();
        $filterT11->setSearchString('fail');
        $resultT11 = $ot->users($filterT11);
        $this->assertTrue(is_array($resultT11['data']));
        $this->assertEquals(0, count($resultT11['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT12 = new Users();
        $filterT12->setSearchString('a');
        $resultT12 = $ot->users($filterT12);
        $this->assertTrue(is_array($resultT12['data']));
        $this->assertEquals(self::NB_USERS, count($resultT12['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT13 = new Users();
        $filterT13->setSearchString('a');
        $filterT13->setIncludeInactive(false);
        $resultT13 = $ot->users($filterT13);
        $this->assertTrue(is_array($resultT13['data']));
        $this->assertEquals(2, count($resultT13['data']));
        //
        $ot = $this->getOnTimeObjectKo();
        $filterT14 = new Users();
        $filterT14->setSearchString('a');
        $filterT14->setIncludeInactive(false);
        $resultT14 = $ot->users($filterT14);
        $this->assertTrue(is_array($resultT14['data']));
        $this->assertEquals(2, count($resultT14['data']));
    }

    /**
     */
    public function testDefects()
    {
        $ot = $this->getOnTimeObjectOk();
        $resultT1 = $ot->defects();
        $this->assertTrue(is_array($resultT1['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT2 = new Defects();
        $resultT2 = $ot->defects($filterT2);
        $this->assertTrue(is_array($resultT2['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT3 = new Defects();
        $filterT3->setId(1);
        $resultT3 = $ot->defects($filterT3);
        $this->assertTrue(is_array($resultT3['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT4 = new Defects();
        $filterT4->setId(9999);
        $resultT4 = $ot->defects($filterT4);
        $this->assertNull($resultT4['data']);
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT5 = new Defects();
        $filterT5->setCustomerId(1);
        $resultT5 = $ot->defects($filterT5);
        $this->assertTrue(is_array($resultT5['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT6 = new Defects();
        $filterT6->setCustomerId(9999);
        $resultT6 = $ot->defects($filterT6);
        $this->assertEmpty($resultT6['data']);
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT7 = new Defects();
        $filterT7->setAssignedToId(1);
        $resultT7 = $ot->defects($filterT7);
        $this->assertEmpty($resultT7['data']);
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT8 = new Defects();
        $filterT8->setAssignedToId(12);
        $resultT8 = $ot->defects($filterT8);
        $this->assertTrue(is_array($resultT8['data']));
        $this->assertTrue(count($resultT8['data']) > 0);
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT9 = new Defects();
        $filterT9->setAssignedToId(9999);
        $resultT9 = $ot->defects($filterT9);
        $this->assertEmpty($resultT9['data']);
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT10 = new Defects();
        $filterT10->setProjectId(2);
        $resultT10 = $ot->defects($filterT10);
        $this->assertTrue(is_array($resultT10['data']));
        $this->assertTrue(count($resultT10['data']) > 0);
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT11 = new Defects();
        $filterT11->setProjectId(9999);
        $resultT11 = $ot->defects($filterT11);
        $this->assertEmpty($resultT11['data']);
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT12 = new Defects();
        $filterT12->setReleaseId(7);
        $resultT12 = $ot->defects($filterT12);
        $this->assertTrue(is_array($resultT12['data']));
        $this->assertTrue(count($resultT12['data']) > 0);
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT13 = new Defects();
        $filterT13->setReleaseId(9999);
        $resultT13 = $ot->defects($filterT13);
        $this->assertEmpty($resultT13['data']);
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT15 = new Defects();
        $filterT15->setId(1);
        $filterT15->setAttachments(true);
        $resultT15 = $ot->defects($filterT15);
        $this->assertEmpty($resultT15['data']);
    }

    /**
     */
    public function testFeatures()
    {
        $ot = $this->getOnTimeObjectOk();
        $resultT1 = $ot->features();
        $this->assertTrue(is_array($resultT1['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT2 = new Features();
        $resultT2 = $ot->features($filterT2);
        $this->assertTrue(is_array($resultT2['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT3 = new Features();
        $filterT3->setId(1);
        $resultT3 = $ot->features($filterT3);
        $this->assertTrue(is_array($resultT3['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT4 = new Features();
        $filterT4->setId(9999);
        $resultT4 = $ot->features($filterT4);
        $this->assertNull($resultT4['data']);
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT5 = new Features();
        $filterT5->setCustomerId(1);
        $resultT5 = $ot->features($filterT5);
        $this->assertTrue(is_array($resultT5['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT6 = new Features();
        $filterT6->setCustomerId(9999);
        $resultT6 = $ot->features($filterT6);
        $this->assertEmpty($resultT6['data']);
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT7 = new Features();
        $filterT7->setAssignedToId(1);
        $resultT7 = $ot->features($filterT7);
        $this->assertEmpty($resultT7['data']);
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT8 = new Features();
        $filterT8->setAssignedToId(12);
        $resultT8 = $ot->features($filterT8);
        $this->assertTrue(is_array($resultT8['data']));
        $this->assertTrue(count($resultT8['data']) > 0);
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT9 = new Features();
        $filterT9->setAssignedToId(9999);
        $resultT9 = $ot->features($filterT9);
        $this->assertEmpty($resultT9['data']);
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT10 = new Features();
        $filterT10->setProjectId(1);
        $resultT10 = $ot->features($filterT10);
        $this->assertTrue(is_array($resultT10['data']));
        $this->assertTrue(count($resultT10['data']) > 0);
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT11 = new Features();
        $filterT11->setProjectId(9999);
        $resultT11 = $ot->features($filterT11);
        $this->assertEmpty($resultT11['data']);
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT12 = new Features();
        $filterT12->setReleaseId(7);
        $resultT12 = $ot->features($filterT12);
        $this->assertTrue(is_array($resultT12['data']));
        $this->assertTrue(count($resultT12['data']) > 0);
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT13 = new Features();
        $filterT13->setReleaseId(9999);
        $resultT13 = $ot->features($filterT13);
        $this->assertEmpty($resultT13['data']);
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT14 = new Features();
        $filterT14->setId(158);
        $filterT14->setAttachments(true);
        $resultT14 = $ot->features($filterT14);
        $this->assertTrue(is_array($resultT14['data']));
        $this->assertTrue(count($resultT14['data']) > 0);
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT15 = new Features();
        $filterT15->setId(1);
        $filterT15->setAttachments(true);
        $resultT15 = $ot->features($filterT15);
        $this->assertEmpty($resultT15['data']);
    }

    /**
     */
    public function testIncidents()
    {
        $ot = $this->getOnTimeObjectOk();
        $resultT1 = $ot->incidents();
        $this->assertTrue(is_array($resultT1['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT2 = new Incidents();
        $resultT2 = $ot->incidents($filterT2);
        $this->assertTrue(is_array($resultT2['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT3 = new Incidents();
        $filterT3->setId(1);
        $resultT3 = $ot->incidents($filterT3);
        $this->assertTrue(is_array($resultT3['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT4 = new Incidents();
        $filterT4->setId(9999);
        $resultT4 = $ot->incidents($filterT4);
        $this->assertNull($resultT4['data']);
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT5 = new Incidents();
        $filterT5->setCustomerId(1);
        $resultT5 = $ot->incidents($filterT5);
        $this->assertTrue(is_array($resultT5['data']));
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT6 = new Incidents();
        $filterT6->setCustomerId(9999);
        $resultT6 = $ot->incidents($filterT6);
        $this->assertEmpty($resultT6['data']);
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT7 = new Incidents();
        $filterT7->setAssignedToId(12);
        $resultT7 = $ot->incidents($filterT7);
        $this->assertEmpty($resultT7['data']);
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT8 = new Incidents();
        $filterT8->setAssignedToId(1);
        $resultT8 = $ot->incidents($filterT8);
        $this->assertTrue(is_array($resultT8['data']));
        $this->assertTrue(count($resultT8['data']) > 0);
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT9 = new Incidents();
        $filterT9->setAssignedToId(9999);
        $resultT9 = $ot->incidents($filterT9);
        $this->assertEmpty($resultT9['data']);
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT10 = new Incidents();
        $filterT10->setProjectId(2);
        $resultT10 = $ot->incidents($filterT10);
        $this->assertTrue(is_array($resultT10['data']));
        $this->assertTrue(count($resultT10['data']) > 0);
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT11 = new Incidents();
        $filterT11->setProjectId(9999);
        $resultT11 = $ot->incidents($filterT11);
        $this->assertEmpty($resultT11['data']);
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT12 = new Incidents();
        $filterT12->setReleaseId(7);
        $resultT12 = $ot->incidents($filterT12);
        $this->assertTrue(is_array($resultT12['data']));
        $this->assertTrue(count($resultT12['data']) > 0);
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT13 = new Incidents();
        $filterT13->setReleaseId(9999);
        $resultT13 = $ot->incidents($filterT13);
        $this->assertEmpty($resultT13['data']);
        //
        $ot = $this->getOnTimeObjectOk();
        $filterT15 = new Incidents();
        $filterT15->setId(1);
        $filterT15->setAttachments(true);
        $resultT15 = $ot->incidents($filterT15);
        $this->assertTrue(count($resultT15['data']) > 0);
    }

    /**
     * We have not the tasks manager on OnTime
     */
    public function testTasks()
    {
        $ot = $this->getOnTimeObjectOk();
        $resultT1 = $ot->tasks();
        $this->assertFalse(count($resultT1['data']) > 0);
    }


    /**
     * @return OnTime
     */
    private function getOnTimeObjectOk()
    {
        $request = $this->getConfigOk();
        $request->setSavedToken($this->getTokenOk());
        return new OnTime($request);
    }

    /**
     * @return OnTime
     */
    private function getOnTimeObjectKo()
    {
        $request = $this->getConfigOk();
        $request->setSavedToken($this->getTokenKo());
        return new OnTime($request);
    }

    /**
     * @return ConnectionRequest
     */
    private function getConfigOk()
    {
        $request = new ConnectionRequest();
        $request->setOntimeUrl('https://ottas.axosoft.com/');
        $request->setClientId('cfa06ce5-c761-4b78-82a8-b4df13cc98ae');
        $request->setClientSecret(
            'w3RwSX9BBxYys3LUVqlSWxXxyfyCuaUXWAsSOZ2vMxAM8eCY1dV41r1CGNkvoJN58ynQWwQOtF4mIUZ7lsulHyvJsFSYXyzVIFgA'
        );
        $request->setUsername('contact@aroy.fr');
        $request->setPassword('ottas33');
        return $request;
    }

    /**
     * @return ConnectionRequest
     */
    private function getConfigKo()
    {
        $request = $this->getConfigOk();
        $request->setClientId('fake-client_id');
        return $request;
    }

    private function getTokenOk()
    {
        // Token generated on 29/01/2015 available until 28/02/2015 11:11
        return '972be899-3aaf-4994-a170-02ef31724ff8';
    }

    private function getTokenKo()
    {
        // FakeToken
        return 'faketoken';
    }
}
