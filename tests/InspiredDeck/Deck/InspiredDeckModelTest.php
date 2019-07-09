<?php

namespace MBLSolutions\InspiredDeck\Deck;

use MBLSolutions\Stubs\TestModel;
use MBLSolutions\TestCase;

class InspiredDeckModelTest extends TestCase
{

    /** @test **/
    public function can_create_a_new_inspired_deck_model(): void
    {
        $model = new TestModel();

        $this->assertInstanceOf(InspiredDeckModel::class, $model);
    }

    /** @test **/
    public function can_fill_attributes_on_model_construction(): void
    {
        $attributes = [
            'id' => 1,
            'name' => 'constructed'
        ];

        $model = new TestModel($attributes);

        $this->assertEquals($attributes, $model->toArray());
    }

    /** @test **/
    public function can_fill_attributes(): void
    {
        $attributes = [
            'id' => 1,
            'name' => 'filled'
        ];

        $model = new TestModel();

        $model->fill($attributes);

        $this->assertEquals($attributes, $model->toArray());
    }

    /** @test */
    public function can_convert_model_to_array(): void
    {
        $attributes = [
            'id' => 1,
            'name' => 'filled'
        ];

        $model = new TestModel($attributes);

        $this->assertEquals($attributes, $model->toArray());
    }

    /** @test **/
    public function can_convert_model_to_json(): void
    {
        $attributes = [
            'id' => 1,
            'name' => 'filled'
        ];

        $model = new TestModel($attributes);

        $this->assertEquals(json_encode($attributes), $model->toJson());
    }

    /** @test **/
    public function can_set_attribute(): void
    {
        $model = new TestModel();

        $model->setAttribute('id', 1);

        $this->assertEquals(1, $model->id);
    }

    /** @test **/
    public function can_get_attribute(): void
    {
        $model = new TestModel([
            'id' => 1
        ]);

        $this->assertEquals(1, $model->getAttribute('id'));
    }

}