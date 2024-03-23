<?php

namespace Tests\Feature;

use App\Http\Controllers\Api\PlacesController;
use App\Http\Requests\PlacesRequest;
use App\Models\Places;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Request;
use Tests\TestCase;

class PlaceControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_method_creates_new_place()
    {
        $requestData = [
            'name' => 'New Place',
            'slug' => 'new-place',
            'city' => 'New City',
            'state' => 'New State'
        ];

        $request = new PlacesRequest($requestData);

        $controller = new PlacesController();

        $response = $controller->store($request);

        $this->assertInstanceOf(\Illuminate\Http\JsonResponse::class, $response);

        $responseData = $response->getData(true);
        $this->assertEquals('New Place', $responseData['name']);
        $this->assertEquals('New City', $responseData['city']);
        $this->assertEquals('New State', $responseData['state']);
        $this->assertDatabaseHas('places', $requestData);
    }

    public function test_update_method_updates_existing_place()
    {
        $place = Places::factory()->create();

        $updateData = [
            'name' => 'Updated Place',
            'city' => 'Updated City',
            'state' => 'Updated State'
        ];

        $request = new PlacesRequest($updateData);

        $controller = new PlacesController();

        $response = $controller->update($request, $place->id);

        $this->assertInstanceOf(\Illuminate\Http\JsonResponse::class, $response);

        $this->assertDatabaseHas('places', [
            'id' => $place->id,
            'name' => 'Updated Place',
            'city' => 'Updated City',
            'state' => 'Updated State'
        ]);
    }

    public function test_index_method_returns_places_filtered_by_name()
    {
        $place1 = Places::factory()->create(['name' => 'Example Place 1']);
        $place2 = Places::factory()->create(['name' => 'Another Place']);
        $place3 = Places::factory()->create(['name' => 'Example Place 2']);

        $request = Request::create('/api/places', 'GET', ['name' => 'Example']);

        $controller = new PlacesController();

        $response = $controller->index($request);

        $this->assertInstanceOf(\Illuminate\Http\JsonResponse::class, $response);

        $responseData = $response->getData(true);
        $this->assertCount(2, $responseData); // Deve haver 2 lugares com 'Example' no nome
        $this->assertEquals($place1->id, $responseData[0]['id']);
        $this->assertEquals($place3->id, $responseData[1]['id']);
    }

    public function test_show_method_returns_specific_place()
    {
        $place = Places::factory()->create();

        $controller = new PlacesController();

        $response = $controller->show($place->id);

        $this->assertInstanceOf(\Illuminate\Http\JsonResponse::class, $response);

        $responseData = $response->getData(true);
        $this->assertEquals($place->id, $responseData['id']);
        $this->assertEquals($place->name, $responseData['name']);
        $this->assertEquals($place->slug, $responseData['slug']);
        $this->assertEquals($place->city, $responseData['city']);
        $this->assertEquals($place->state, $responseData['state']);
    }
}
