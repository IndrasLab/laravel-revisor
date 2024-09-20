<?php

declare(strict_types=1);

namespace Indra\Revisor\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Indra\Revisor\Enums\RevisorMode;
use Indra\Revisor\Facades\Revisor;

trait HasRevisor
{
    use HasPublishing;
    use HasVersioning;

    protected ?RevisorMode $mode = null;

    /*
     * Overrides Model::getTable to return the appropriate
     * table (draft, version, published) based on
     * the current RevisorMode
    **/
    public function getTable(): string
    {
        return $this->table ?? Revisor::getSuffixedTableNameFor($this->getBaseTable());
    }

    /*
     * Get the base table name for the model
     **/
    public function getBaseTable(): string
    {
        return $this->baseTable ?? Str::snake(Str::pluralStudly(class_basename($this)));
    }

    /*
     * Get the Draft table name for the model
     **/
    public function getDraftTable(): string
    {
        return Revisor::getDraftTableFor($this->getBaseTable());
    }

    /*
     * Get a Builder instance for the Draft table
     **/
    public static function withDraftTable(): Builder
    {
        $instance = new static;

        return $instance->setTable($instance->getDraftTable())->newQuery();
    }

    /*
     * Check if the model is a Draft table record
     **/
    public function isDraftTableRecord(): bool
    {
        return $this->getTable() === $this->getDraftTable();
    }
}
