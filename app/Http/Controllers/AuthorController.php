<?php

namespace App\Http\Controllers;

use App\Author;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class AuthorController
 * @package App\Http\Controllers
 */
class AuthorController extends Controller
{
    use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * return the list of authors
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $authors = Author::all();
        return $authors;
    }

    /**
     * create on author
     *
     * @param Request $response
     * @return Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required| max:255',
            'country' => 'required| max:255',
            'gender' => 'required| max:255 | in:male,female',
        ];
        $this->validate($request,$rules);
        Author::create($request->all());
        return $this->success($request->all(), Response::HTTP_CREATED);
    }

    /**
     * get on author
     *
     * @param $authorId
     * @return Illuminate\Http\JsonResponse
     */
    public function show($authorId)
    {
        $author = Author::findOrFail($authorId);
        return $this->success($author);
    }


    /**
     * update on or more authors
     * @param Request $request
     * @param $authorId
     * @return Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $authorId)
    {
        $rules = [
            'name' => 'max:255',
            'country' => 'max:255',
            'gender' => 'max:255 | in:male,female',
        ];
        $this->validate($request,$rules);
        $author = Author::findOrFail($authorId);
        $author->fill($request->all());
        if($author->isClean()) {
            return $this->error('can not update an empty object', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $author->save();
        return $this->success($author);
    }


    /**
     * delete an author
     * @param $authorId
     * @return Illuminate\Http\JsonResponse
     */
    public function destroy($authorId)
    {
        $author = Author::findOrFail($authorId);
        $author->delete();
        return $this->success($author);
    }
}
