package com.softsecapp;

import android.content.Intent;
import android.os.Bundle;

import com.google.android.material.appbar.CollapsingToolbarLayout;
import com.google.android.material.floatingactionbutton.FloatingActionButton;

import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;

import android.util.Log;
import android.view.View;
import android.widget.TextView;

import java.util.ArrayList;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Retrofit;
import retrofit2.adapter.rxjava2.RxJava2CallAdapterFactory;
import retrofit2.converter.gson.GsonConverterFactory;

public class Messages extends AppCompatActivity {
    TextView messageFeedView;
    String empty;

    private SeeMesagesService seeMesagesService;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_messages);
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        CollapsingToolbarLayout toolBarLayout = (CollapsingToolbarLayout) findViewById(R.id.toolbar_layout);
        toolBarLayout.setTitle(getTitle());

        messageFeedView = (TextView)findViewById(R.id.msgFeed);
        String sessionId_String = getIntent().getStringExtra("EXTRA_SESSION_ID");

        //messageFeedView = findViewById(R.id.feilmeldingsBoks);

        FloatingActionButton fab = (FloatingActionButton) findViewById(R.id.fab);

        Retrofit retrofit = new Retrofit.Builder()
                .addCallAdapterFactory(RxJava2CallAdapterFactory.create())
                .addConverterFactory(GsonConverterFactory.create())
                .baseUrl("http://158.39.188.201/steg2/prosjektoppgave_Datasikkerhet/api/")
                .build();

        seeMesagesService = retrofit.create(SeeMesagesService.class);
        Call<GetMessages> call = seeMesagesService.getMessages(sessionId_String);


        call.enqueue(new Callback<GetMessages>() {
            @Override
            public void onResponse(Call<GetMessages> call, retrofit2.Response<GetMessages> response) {
                if (!response.isSuccessful()) {
                    messageFeedView.setText("Code: " + response.code());
                    Log.d("OnResponse", String.valueOf(response.code()));
                    return;
                }
                ArrayList<Answer> answers = response.body().getAnswer();

                String content = " ";

                for (Answer answer : answers) {

                    content += answer.getEmnekode() + "\n";
                    content += answer.getMelding() + "\n";
                    if (answer.getSvar() != null) {
                        content += answer.getSvar() + "\n";
                    }
                    else
                        content += "Ikke besvart" + "\n";
                    content += "__________"  + "\n";

                }

                messageFeedView.setText(content);

            }

            @Override
            public void onFailure(Call<GetMessages> call, Throwable t) {
                messageFeedView.setText(t.getMessage());
                Log.d("Debug", String.valueOf(t.getMessage()));
            }

        });


        fab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(getBaseContext(), SendMessages.class);
                intent.putExtra("EXTRA_SESSION_ID", sessionId_String);
                startActivity(intent);
            }
        });
    }
}