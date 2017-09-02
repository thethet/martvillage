<?php

class Helpers {
	public static function uploadPhoto() {
		$destinationPath = 'uploads';
		$extension       = Input::file('prd_img')->getClientOriginalExtension();
		$fileName        = rand(11111, 99999) . '.' . $extension;
		Input::file('prd_img')->move($destinationPath, $fileName);
		$data = array(
			'prd_name'       => $prd_name,
			'prd_cat'        => $prd_cat,
			'prd_sub_cat'    => $prd_sub_cat,
			'prd_img'        => $fileName,
			'remember_token' => $remember_token,
			'created_at'     => $time,
		);
		if (DB::table('products')->insert($data)) {
			return redirect('add-product')->with('success', 'Product Succssfully Added.');
		} else {
			return redirect('add-product')->with('error', 'Something wrong please try again.');
		}
	}
}
