<?php

namespace App\Passwords;

use App\User;
use Carbon\Carbon;
use Illuminate\Auth\Passwords\DatabaseTokenRepository as BaseDatabaseTokenRepository;

class DatabaseTokenRepository extends BaseDatabaseTokenRepository
{
    public function create(User $user)
    {

   
        $this->deleteExisting($user);

        $token = $this->createNewToken();

        $this->getTable()->insert($this->getPayload(
            $user->username, $user->email, $token
        ));

        return $token;
    }

    protected function deleteExisting(User $user)
    {
        return $this->getTable()->where('email', $user->email)->delete();
    }

    protected function getPayload($username, $email, $token)
    {
        return [
            'username' => $username,
            'email' => $email,
            'token' => $this->hasher->make($token),
            'created_at' => new Carbon,
        ];
    }

    public function exists(User $user, $token)
    {
        $record = (array) $this->getTable()->where(
            'email', $user->email
        )->first();

        return $record &&
               ! $this->tokenExpired($record['created_at']) &&
                 $this->hasher->check($token, $record['token']);
    }
}