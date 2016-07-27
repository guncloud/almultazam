<?php

Route::group(['prefix' => 'siswa', 'namespace' => 'Modules\Siswa\Http\Controllers', 'middleware' => 'siswa'], function()
{ 
	Route::get('/', 'DashboardController@index');
    Route::get('/teacher/search', 'TeacherController@search');
    Route::get('/student/search', 'SiswaController@search');
	Route::get('/language/score', 'LanguageController@score');

    Route::controller('/teacher', 'TeacherController');

    Route::resource('/siswa', 'SiswaController');
	Route::resource('/classroom', 'ClassroomController');
	Route::resource('/hostel', 'HostelController');
	Route::resource('/subject', 'SubjectController');
	Route::resource('/contract', 'ContractController');
	Route::resource('/ekskul', 'EkskulController');
	Route::resource('/attendance', 'AttendanceController');
	Route::resource('/score', 'ScoreController');
	Route::resource('/violation', 'ViolationController');
	Route::resource('/achievement', 'AchievementController');
	Route::resource('/config', 'ConfigController');
	Route::resource('/language', 'LanguageController');
	Route::resource('/recitation', 'RecitationController');
	Route::resource('/reading', 'ReadingController');
	Route::resource('/language-student', 'LanguageStudentController');
	Route::resource('/student-ekskul', 'StudentEkskulController');
		
	Route::get('naik-kelas/count-next-grade', 'GradeUpController@countNextGrade');
	Route::resource('/naik-kelas', 'GradeUpController');


});