<?php

namespace App\Traits\Crud;

trait HandlesDelete
{
    public function delete(int $id): void
    {
        $this->repository->delete($id);
    }
}
