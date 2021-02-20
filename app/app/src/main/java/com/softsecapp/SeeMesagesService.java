package com.softsecapp;

import retrofit2.Call;
import retrofit2.http.GET;
import retrofit2.http.Query;

public interface SeeMesagesService {
    @GET("api_hentSporsmal.php")
    Call<GetMessages> getMessages(
            @Query("brukerid") String brukerid
    );
}
