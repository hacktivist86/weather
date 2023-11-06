<?php

namespace App\Components\User\Repositories;

use App\Components\Core\BaseRepository;
use App\Components\Order\Models\Order;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends BaseRepository
{
    /**
     * @param Order $model
     */
    public function __construct(Order $model)
    {
        parent::__construct($model);
    }

    public function getOrderByUniqId(string $id, string $fieldName): ?Model
    {
        return $this->findOneBy([$fieldName => $id]);
    }
}
