<?php

use Slim\Http;
require __DIR__ . "/../src/app.php";

class ExampleTest extends PHPUnit_Framework_TestCase
{
    private $app;

    public function setUp()
    {
        $this->app = new App();
    }

    /**
     * Make a request given a uri
     **/
    private function make_request($uri)
    {
        $env = \Slim\Http\Environment::mock();
        $uri = \Slim\Http\Uri::createFromString($uri);
        $headers = \Slim\Http\Headers::createFromEnvironment($env);
        $cookies = [];
        $serverParams = $env->all();
        $body = new \Slim\Http\RequestBody();
        $request = new \Slim\Http\Request('GET', $uri, $headers, $cookies, $serverParams, $body);

        $app = $this->app;

        $response = $app($request, new \Slim\Http\Response());
        $response->getBody()->rewind();
        return $response;
    }

    /**
     * Test the api call to return an individual item
     **/ 
    public function testGetItem()
    {
        // Get items to find the the first to test with
        $uri = 'api/item/1';
        $response = $this->make_request($uri);
        $item = json_decode($response->getBody()->getContents(), TRUE);

        $this->assertTrue(isset($item['id']), 'A non-banned Item contains the "id" field');
        $this->assertTrue(isset($item['title']), 'A non-banned Item contains the "title" field');
        $this->assertTrue(isset($item['description']), 'A non-banned Item contains the "description" field');
        $this->assertTrue(isset($item['category']), 'A non-banned Item contains the "category" field');
        $this->assertTrue(isset($item['price']), 'A non-banned Item contains the "price" field');
        $this->assertTrue(isset($item['name']), 'A non-banned Item contains the "name" field');
        $this->assertTrue(isset($item['latitude']), 'A non-banned Item contains the "latitude" field');
        $this->assertTrue(isset($item['longitude']), 'A non-banned Item contains the "longitude" field');
        $this->assertTrue(isset($item['status']), 'A non-banned Item contains the "status" field');
        $this->assertTrue(isset($item['create_date']), 'A non-banned Item contains the "create_date" field');

        $this->assertNotEquals('Banned', $item['status'], 'The Item does not have a banned status');
    }

    /**
     * Test the api call to return an individual banned item
     **/ 
    public function testGetBannedItem()
    {
        // Get items to find the the first to test with
        $uri = 'api/item/3';
        $response = $this->make_request($uri);
        $item = json_decode($response->getBody()->getContents(), TRUE);

        $this->assertTrue(isset($item['id']), 'A banned Item contains the "id" field');
        $this->assertTrue(isset($item['title']), 'A banned Item contains the "title" field');
        $this->assertTrue(isset($item['description']), 'A banned Item contains the "description" field');
        $this->assertTrue(isset($item['category']), 'A banned Item contains the "category" field');
        $this->assertTrue(isset($item['price']), 'A banned Item contains the "price" field');
        $this->assertFalse(isset($item['name']), 'A banned Item does not contains the "name" field');
        $this->assertTrue(isset($item['latitude']), 'A banned Item contains the "latitude" field');
        $this->assertTrue(isset($item['longitude']), 'A banned Item contains the "longitude" field');
        $this->assertTrue(isset($item['status']), 'A banned Item contains the "status" field');
        $this->assertFalse(isset($item['create_date']), 'A banned Item does not contains the "create_date" field');

        $this->assertEquals('Banned', $item['status'], 'The Item has a banned status');
    }

    /**
     * Test the api call to return an item that doesnt exist
     **/ 
    public function testGetInvalidItem()
    {
        // Get items to find the the first to test with
        $uri = 'api/item/4';
        $response = $this->make_request($uri);
        $status = $response->getStatusCode();
 
        $this->assertEquals(404, $status, 'A 404 status is returned for an item that doesnt exist');
    }

    /**
     * Test the api call to return all items
     **/ 
    public function testGetAllItems()
    {
        // Get items to find the the first to test with
        $uri = 'api/items';
        $response = $this->make_request($uri);
        $result = json_decode($response->getBody()->getContents(), TRUE);
        $items = $result['items'];
 
        $this->assertEquals(3, count($items), 'Get all items in the database');
    }

    /**
     * Test the api call to return all items belonging to a category
     **/ 
    public function testGetAllItemsByCategory()
    {
        // Get items to find the the first to test with
        $uri = 'api/items?category=Furniture';
        $response = $this->make_request($uri);
        $result = json_decode($response->getBody()->getContents(), TRUE);
        $items = $result['items'];
 
        foreach ($items as $item)
        {
            $this->assertEquals('Furniture', $item['category'], 'Item with ID: ' . $item['id'] . ' belongs to the furniture category');
        }
    }

    /**
     * Test the api call to return all items belonging to a seller
     **/ 
    public function testGetAllItemsByName()
    {
        // Get items to find the the first to test with
        $uri = 'api/items?seller=Bob Henry';
        $response = $this->make_request($uri);
        $result = json_decode($response->getBody()->getContents(), TRUE);
        $items = $result['items'];
 
        foreach ($items as $item)
        {
            $this->assertEquals('Bob Henry', $item['name'], 'Item with ID: ' . $item['id'] . ' belongs to Bob Henry');
        }
    }

    /**
     * Test the api call to return an empty list of items for a seller that
     * doesn't exist
     **/ 
    public function testGetAllItemsByNameDoesntExist()
    {
        // Get items to find the the first to test with
        $uri = 'api/items?seller=Name Doesnt Exist';
        $response = $this->make_request($uri);
        $result = json_decode($response->getBody()->getContents(), TRUE);
        $items = $result['items'];
 
        $this->assertEquals(0, count($items), 'Get all items in the database');
    }
}