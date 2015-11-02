<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::get('artikel', 'ArtikelController@index');

Route::get('artikel/add', 'ArtikelController@create');

Route::post('artikel/save', 'ArtikelController@store');

Route::get('artikel/edit/{id}', 'ArtikelController@edit');

Route::post('artikel/update', 'ArtikelController@update');

Route::get('artikel/delete/{id}', 'ArtikelController@destroy');

Route::post('komentar','ArtikelController@komentar');

Route::get('load_comments/{id}', function ($id)
{
	$data = App\Komentar::where('idposts',$id)->get();
	echo json_encode($data);
});

Route::get('/images/{filename}',
	function($filename){

		$path = storage_path().'/'.$filename;
		$file = File::get($path);
		$type = File::mimeType($path);
		$response =  Response::make($file, 200);
		$response->header("Content-Type", $type);

		return $response;


	});
Route::get('/pdf/{slug}', 'WelcomeController@showpdf');

Route::get('/{slug}', 'WelcomeController@show');

Route::get('/mail/{slug}',function($slug)
{
	$artikel = \App\Posts::where('slug',$slug)->first();

	Mail::send('artikel.pdf',['data'=> $artikel],
		function($message)
		{
			$message->to(Auth::user()->email, Auth::user()->name)
			->subject("Update Artikel");
		});
	return redirect(url());
});

Route::get('api/artikel/all',function ()
{
	$data = \App\Posts::all();
	$arr = array();

	foreach ($data as $key) {
		$arr[] = array(
						'slug'=>$key['slug'],
						'isi'=>$key['isi'],
						'create_at'=>$key['create_at'],
						'author'=>\App\User::find($key['idpengguna'])['email'],
						'tag'=>$key['tag'],
						'sampul'=>url('images/'.$key['sampul']),
						'judul'=>$key['judul']
						);
	}
	echo json_encode($arr);
});

Route::get('api/artikel/detail/{slug}',function($slug)
{
	$key = \App\Posts::where('slug',$slug)->first();

		$arr = array(
						'slug'=>$key['slug'],
						'isi'=>$key['isi'],
						'create_at'=>$key['create_at'],
						'author'=>\App\User::find($key['idpengguna'])['email'],
						'tag'=>$key['tag'],
						'sampul'=>url('images/'.$key['sampul']),
						'judul'=>$key['judul']
						);
		if(sizeof($key)==0){
			$data = array('status'=>"Error",
							'error_code'=>404,
							'name'=>'artikel_notfound',
							'msg'=>'Artikel Not Found');
			echo json_encode($data);
		}else{
			echo json_encode($arr);	
		}	


});

Route::get('api/artikel/{type}/{cari}',function($type,$cari)
{
	$avail = array('idpengguna','judul','slug','tags');

	if(in_array($type, $avail)){


	$data = \App\Posts::where($type,$cari)->get();

		$arr = array();

		foreach ($data as $key) {
			$arr=array(
						'slug'=>$key['slug'],
						'isi'=>$key['isi'],
						'create_at'=>$key['create_at'],
						'author'=>\App\User::find($key['idpengguna'])['email'],
						'tag'=>$key['tag'],
						'sampul'=>url('images/'.$key['sampul']),
						'judul'=>$key['judul']
						);
}
		if(sizeof($data)==0){
			$data = array('status'=>"Error",
							'error_code'=>404,
							'name'=>'artikel_notfound',
							'msg'=>'Artikel Not Found');
			echo json_encode($data);
		}else{
			echo json_encode($arr);	
		}
	}else{
		$data = array('status'=>"Error",
							'error_code'=>304,
							'name'=>'type_notfound',
							'msg'=>'Type Not Found');
			echo json_encode($data);
	}
});	

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',

	]);
