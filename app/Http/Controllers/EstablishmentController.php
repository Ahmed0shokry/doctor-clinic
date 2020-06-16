<?php
namespace App\Http\Controllers;

use App\Models\Establishment;
use App\Models\Section;
use App\Traits\ApiResponser;
use AppCore\Domain\Services\EstablishmentSearch;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class EstablishmentController
 * @package App\Http\Controllers
 */
class EstablishmentController extends Controller
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

    public function search(Request $request, EstablishmentSearch $repository)
    {
        $sections = $repository->search($request->all());
        return $this->success($sections);
    }

    public function singleEstablishment(Request $request) {
        $establishment = Establishment::where('slug', $request->all()['slug'])->first();
        return $this->success($establishment);
    }

    /**
     * return the list of sections
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return Section::all();

    }

    /**
     * create on section
     *
     * @param Request $response
     * @return Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
//        $rules = [
//            'name' => 'required| max:255',
//            'country' => 'required| max:255',
//            'gender' => 'required| max:255 | in:male,female',
//        ];
//        $this->validate($request,$rules);
        Section::create($request->all());
        return $this->success($request->all(), Response::HTTP_CREATED);
    }

    /**
     * get on section
     *
     * @param $sectionId
     * @return Illuminate\Http\JsonResponse
     */
    public function show($sectionId)
    {
        $section = Section::findOrFail($sectionId);
        return $this->success($section);
    }


    /**
     * update on or more sections
     * @param Request $request
     * @param $sectionId
     * @return Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $sectionId)
    {
//        $rules = [
//            'name' => 'max:255',
//            'country' => 'max:255',
//            'gender' => 'max:255 | in:male,female',
//        ];
//        $this->validate($request,$rules);
        $section = Section::findOrFail($sectionId);
        $section->fill($request->all());
        if ($section->isClean()) {
            return $this->error('can not update an empty object', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $section->save();
        return $this->success($section);
    }


    /**
     * delete an section
     * @param $sectionId
     * @return Illuminate\Http\JsonResponse
     */
    public function destroy($sectionId)
    {
        $section = Section::findOrFail($sectionId);
        $section->delete();
        return $this->success($section);
    }
}
