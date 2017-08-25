<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;



use App\BMI;
use Auth;


class BMIsController extends Controller

{

    public function __construct()
    {
        $this->middleware('auth');
    }

	public function index()
	{
		$BMI_obj = BMI::where('user_id', Auth::id())->paginate(5);
		return view('BMI.index',compact('BMI_obj'));
	}
	public function show(BMI $bmi)
    	{
        	return view('BMI.show', compact('bmi'));
    	}

    	public function check()
    	{
		$all = BMI::where('user_id', Auth::id())->get();
         	$last = collect($all)->last();

         	if ($last) {

        		\JavaScript::put([

         		'classification' => $last->classifitacion,
         		'bmi' => $last->bmicalculate,
        		]);

         	}

        	$bmi = BMI::all();
        	return view('BMI.check-bmi', compact('bmi'));
    	}

    	public function store(Request $request)
    	{
        	$bmi = new BMI;
        	$bmi->weight = $request->weight;
        	$bmi->height = $request->height;
        	$height2 = ($bmi->height) * ($bmi->height);
        	$bmi->bmicalculate = ( $bmi->weight / $height2 );

        	if (($bmi->bmicalculate) < 16.00)
        	{
            		$bmi->classification = 'Severely Underweight';
        	}
        	elseif (($bmi->imccalculado >= 16.00) && ($bmi->bmicalculate <= 18.40))
        	{
            		$bmi->classification = 'Underweight';
        	}
        	elseif (($bmi->imccalculate >= 18.5) && ($bmi->bmicalculate  <= 24.99))
        	{
            		$bmi->classification = 'Normal';
        	}
        	elseif (($bmi->bmicalculate >= 25.00)  && ($bmi->bmicalculate <= 29.99))
        	{
            		$bmi->classification = 'Overweight';
        	}
        	elseif (($bmi->bmicalculate >= 30.00) && ($bmi->bmicalculate <= 34.99))
        	{
            		$bmi->classification = 'Moderately Obese';
        	}
        	elseif (($bmi->bmicalculate >= 35.00) && ($bmi->bmicalculate <= 39.99))
        	{
            		$bmi->classification = 'Severely Obese';
        	}
        	elseif (($bmi->bmicalculate) >= 40.00 )
        	{
            		$bmi->clasificacion = 'Very Severely Obese';
        	}

        	$bmi->user_id = Auth::id();
        	$bmi->save();

       		return redirect('/BMI');

	}

    	public function result()
    	{
         	$all = BMI::where('user_id', Auth::id())->get();
         	$last = collect($all)->last();
         	return $last;
    	}
}
