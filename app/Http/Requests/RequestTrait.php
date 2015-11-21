<?

namespace App\Http\Requests;

use \App\Http\Requests\PostRequest as Request;

trait RequestTrait {

	public function modifyInput(Request $request) {
		return $request->all();
	}

	public function rules()
    {
    	return [];
    }
}