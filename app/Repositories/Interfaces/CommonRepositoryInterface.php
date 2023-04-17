<?php
namespace App\Repositories\Interfaces;

use App\Http\Requests\Common\CommonRequest;
use Illuminate\Http\Request;

Interface CommonRepositoryInterface {
    public function list();
    public function create($data);
    public function get($id);
    public function addMyself($id);
    public function destroy($id);
}