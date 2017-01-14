<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Post;
use App\Vaccine;
use App\Immunization;
use Session;
use PDF;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $post = Post::orderBy('id', 'desc')->paginate(10);
        $vaccine = Vaccine::all();
        return view('posts.index')->withPosts($post)->withVaccines($vaccine);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
                'pat_fname' => 'required|max:255',
                'pat_lname' => 'required|max:255',
                'pat_bdate' => 'required|max:255',
                'weight' => 'required|max:255',
                'height' => 'required|max:255',
                'age' => 'required|max:255',
                'sex' => 'required|min:1',
                'mother_name' => 'required|max:255',
                'address' => 'required|max:255',
                'pat_uname' => 'required|max:255',
                'pat_pass' => 'required|max:255'
        ]);
        
        $post = new Post;
        $post->pat_fname = $request->pat_fname;
        $post->pat_lname = $request->pat_lname;
        $post->pat_bdate = $request->pat_bdate;
        $post->weight = $request->weight;
        $post->height = $request->height;
        $post->age = $request->age;
        $post->sex = $request->sex;
        $post->mother_name = $request->mother_name;
        $post->address = $request->address;
        $post->pat_uname = $request->pat_uname;
        $post->pat_pass = $request->pat_pass;
        $post->registration_date = $request->registration_date;

        $post->save();

        echo $post->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $post = Post::find($id);
        $immunizationstatus = Immunization::where('p_id', '=' , $id)->orderBy('id','desc')->get();

        $vaccination_date = [];
        $values = [];
        $null_values = [];
        $count = 0;

        while ($count<12) {
            if ($count >= sizeof($immunizationstatus)){
                while ($count<12) {
                    $null_values[] = 'Empty';
                    $count++;
                }
                break;
               
            }else{
                $anotherValue = $immunizationstatus[$count];
            }
            $values[] =  $anotherValue->vaccination_received;
            $count++;
        }
         foreach (array_merge($values,$null_values) as $merge ) {
             $vaccination_date[] = $merge;
         }

         

         


        return view('posts.show')->withPosts($post)->withVaccinationdates($vaccination_date)->withImmunizationstatuses($immunizationstatus);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit')->withPost($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $post = Post::find($id);
        // if ($request->slug == $post->slug) {
        //     $this->validate($request, array(
        //         'title' => 'required|max:255',
        //         'body' => 'required'
        //     ));
        // } else {
        //     $this->validate($request, array(
        //         'title' => 'required|max:255',
        //         'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
        //         'body' => 'required'
        //     ));
        // }
        $post = Post::find($request->id);

        $post->$request['col'] = $request->value;

        $post->save();

        
        echo $request->value;
      

        // Session::flash('success' , 'Successfully saved.');

        // return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();       
        Session::flash('Success', 'Record Successfully Deleted');
        return redirect()->route('posts.index');
    }

    public function search(Request $request){
        if ($request->ajax()) {
            $output = "";
            if (empty($request->sort)) {
                $sort = 'id';
            }else{
                $sort = $request->sort;
            }

            $posts = Post::orderBy($sort, 'asc')->where('pat_fname','like', $request->search.'%')->orWhere('pat_lname','like', $request->search.'%')->orWhere('address','like', $request->search.'%')->get();
            
            if ($posts) {
                foreach ($posts as  $post) {
                    $output .= "<tr><td class='date registration_date' id='".$post->id."'>".$post->registration_date."</td>".
                               "<td class='date pat_bdate' id='".$post->id."'>".$post->pat_bdate."</td>".
                               "<td class='edit pat_lname' id='".$post->id."'>".$post->pat_lname."</td>".
                               "<td class='edit pat_fname' id='".$post->id."'>".$post->pat_fname."</td>".
                               "<td class='edit weight' id='".$post->id."'>".$post->weight."</td>".
                               "<td class='edit height' id='".$post->id."'>".$post->height."</td>".
                               "<td class='edit age' id='".$post->id."'>".$post->age."</td>".
                               "<td class='edit sex' id='".$post->id."'>".$post->sex."</td>".
                               "<td class='edit mother_name' id='".$post->id."'>".$post->mother_name."</td>".
                               "<td class='edit address' id='".$post->id."'>".$post->address."</td>".
                               "<td><a href='posts/".$post->id."'><p>View Profile</p></a><td>".
                               "<td><a href='checkup/".$post->id."'><p>Check Up</p></a><td>".
                               "<td><a href='immunization/".$post->id."'><p>Immunization</p></a><td>".
                               "<td><a href='pdf/".$post->id."'><p>Download PDF</p></a><td></tr>";

                              
                }

                return Response($output);
            }else{
                return Response()->json(['no'=>'Not Found']);
            }
        }
        
    }
    public function pdf($id){
        $post = Post::find($id);

        $immunizationstatus = Immunization::where('p_id', '=' , $id)->orderBy('id','desc')->get();

        $vaccination_date = [];
        $values = [];
        $null_values = [];
        $count = 0;
        
        while ($count<12) {
            if ($count >= sizeof($immunizationstatus)){
                while ($count<12) {
                    $null_values[] = 'Empty';
                    $count++;
                }
                break;
               
            }else{
                $anotherValue = $immunizationstatus[$count];
            }
            $values[] =  $anotherValue->vaccination_received;
            $count++;
        }
         foreach (array_merge($values,$null_values) as $merge ) {
             $vaccination_date[] = $merge;
         }


        $pdf = PDF::loadView('pdf/pdf',['posts' => $post,'vaccinationdates' => $vaccination_date]);
        $pdf->setPaper('A4', 'landscape');

        return $pdf->stream('invoice.pdf');

    }

  
}
