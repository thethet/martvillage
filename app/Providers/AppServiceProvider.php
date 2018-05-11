<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot() {
		Validator::extend('phone', function ($attribute, $value, $parameters, $validator) {
			return preg_match('%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i', $value) && strlen($value) >= 10;
		});

		Validator::replacer('phone', function ($message, $attribute, $rule, $parameters) {
			return str_replace(':attribute', $attribute, ':attribute is invalid phone number');
		});

		Validator::extend('name', function ($attribute, $value, $parameters, $validator) {
			return preg_match('/^([^0-9]*)$/', $value) && strlen($value) >= 10;
		});

		Validator::replacer('name', function ($message, $attribute, $rule, $parameters) {
			return str_replace(':attribute', $attribute, ':attribute may only contain letters');
		});

		Validator::extend('after_or_equal', function ($attribute, $value, $parameters, $validator) {
			return strtotime($value) >= strtotime($parameters[0]);
		});

		Validator::replacer('after_or_equal', function ($message, $attribute, $rule, $parameters) {
			$message = str_replace(':attribute', $attribute, 'The :attribute must be a date after or equal to :date.');
			return str_replace(':date', $parameters[0], 'The arriival date must be a date after or equal to :date.');
		});

	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register() {
		//
	}
}
