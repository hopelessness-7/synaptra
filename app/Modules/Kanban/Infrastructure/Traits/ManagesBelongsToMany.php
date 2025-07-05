<?php

namespace App\Modules\Kanban\Infrastructure\Traits;

use App\Modules\Kanban\Domain\Enums\RelationTypeEnum;
use App\Modules\Kanban\Infrastructure\Repositories\Eloquent\TaskRelationRepository;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

trait ManagesBelongsToMany
{
    /**
     * Добавить связь(и) в BelongsToMany.
     *
     * @param BelongsToMany $relation
     * @param int|int[] $ids
     * @return void
     */
    protected function attachRelation(BelongsToMany $relation, int|array $ids): void
    {
        $ids = array_filter((array) $ids);

        if (!empty($ids)) {
            $relation->attach($ids);
        }

    }

    /**
     * Удалить связь(и) из BelongsToMany.
     *
     * @param BelongsToMany $relation
     * @param int|int[] $ids
     * @return void
     */
    protected function detachRelation(BelongsToMany $relation, int|array $ids): void
    {
        $ids = array_filter((array) $ids);

        if (!empty($ids)) {
            $relation->detach((array) $ids);
        }
    }

    /**
     * Добавить связь(и) в BelongsToMany используя тип.
     *
     * @param BelongsToMany $relation
     * @param int|int[] $ids
     * @param RelationTypeEnum $relationType
     * @return void
     */
    protected function attachRelationWithType(BelongsToMany $relation, int|array $ids, RelationTypeEnum $relationType): void
    {
        $ids = (array) $ids;
        $data = [];

        foreach ($ids as $id) {
            $data[$id] = ['relation_type' => $relationType];
        }

        $this->attachRelation($relation, $data);
    }

    /**
     * Удалить связь(и) в BelongsToMany используя тип.
     *
     * @param int|int[] $ids
     * @param RelationTypeEnum $relationType
     * @param int $taskId
     * @return void
     */
    protected function detachRelationWithType(int|array $ids,  RelationTypeEnum $relationType, int $taskId): void
    {
        app(TaskRelationRepository::class)->deleteRelationWithType((array) $ids, $relationType, $taskId);
    }
}
