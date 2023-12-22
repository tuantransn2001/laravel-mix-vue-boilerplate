<?php

namespace App\Repositories;

use App\Models\User;
use BaseRepository;
use IUserRepository;

class UserRepository extends BaseRepository implements IUserRepository
{

    /**
     * UserRepository constructor.
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::_construct($model);
    }
}
