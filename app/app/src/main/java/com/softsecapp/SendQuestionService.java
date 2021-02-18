package com.softsecapp;

import retrofit2.Call;
import retrofit2.http.GET;
import retrofit2.http.Query;

public interface SendQuestionService {
    @GET("api_sendSporsmal.php")
    Call<Void> sendQuestion(
            @Query("brukerid") String brukerid,
            @Query("emnekode") String emnekode,
            @Query("sporsmal") String sporsmal
    );
}



//api_sendSporsmal.php?brukerid=11&emnekode=ITF888&sporsmal=test

