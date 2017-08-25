<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;



use App\Calories;
use Auth;
use JavaScript;


class CaloriesController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

	public function index()
	{
		$calorie_obj = Calories::where('user_id', Auth::id())->paginate(5);
		return view('calories.index',compact('calorie_obj'));
	}
	public function show(Calories $calorie)
    	{
        	return view('calories.show', compact('calorie'));
    	}

    	public function check()
    	{
		$all = Calories::where('user_id', Auth::id())->get();
         	$last = collect($all)->last();

         	if ($last) {

        		JavaScript::put([
         		'calorie' => $last->caloriecalculate,
        		]);

         	}

        	$calorie = Calories::all();
        	return view('calories.check-calorie', compact('calorie'));
    	}

    	public function store(Request $request)
    	{
        	$calorie = new Calories;
        	$calorie->weight = $request->weight;
        	$calorie->caloriecalculate = ( $calorie->weight * 30 );

        	$calorie->user_id = Auth::id();
        	$calorie->save();

       		return redirect('/calories');

	}

    	public function result()
    	{
         	$all = Calories::where('user_id', Auth::id())->get();
         	$last = collect($all)->last();
         	return $last;
    	}
}
