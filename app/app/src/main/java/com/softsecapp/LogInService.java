package com.softsecapp;

import retrofit2.Call;
import retrofit2.http.GET;
import retrofit2.http.Query;

public interface LogInService {
    @GET("api_loginBruker.php")
    Call<Response> getlogin(
            @Query("epost") String epost,
            @Query("passord") String passord
    );
}
