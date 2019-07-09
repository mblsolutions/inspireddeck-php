<?php

namespace MBLSolutions\InspiredDeck\Deck;

use MBLSolutions\InspiredDeck\Deck\Concerns\HasAttributes;

abstract class InspiredDeckModel
{
    use HasAttributes;

    /**
     * Create a New Inspired Deck Modal Instance
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->fill($attributes);
    }

    /**
     * Fill attributes
     *
     * @param array $attributes
     * @return InspiredDeckModel
     */
    public function fill(array $attributes): self
    {
        foreach ($attributes as $key => $value) {
            $this->setAttribute($key, $value);
        }

        return $this;
    }

    /**
     * Get attributes from the model
     *
     * @param $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->getAttribute($key);
    }

    /**
     * Set attribute on the model
     *
     * @param $key
     * @param $value
     * @return void
     */
    public function __set($key, $value): void
    {
        $this->setAttribute($key, $value);
    }

    /**
     * Check if an attribute exists on the model
     *
     * @param $key
     * @return bool
     */
    public function __isset($key): bool
    {
        return $this->hasAttribute($key);
    }

    /**
     * Unset an attribute on the model
     *
     * @param $key
     * @return void
     */
    public function __unset($key): void
    {
        $this->unsetAttribute($key);
    }

    /**
     * Convert model attributes to array
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->attributesToArray();
    }

    /**
     * Convert model attributes to Json
     *
     * @return string
     */
    public function toJson(): string
    {
        return $this->attributesToJson();
    }

}