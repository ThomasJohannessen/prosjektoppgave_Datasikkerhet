package com.softsecapp;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.Toast;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Retrofit;
import retrofit2.adapter.rxjava2.RxJava2CallAdapterFactory;
import retrofit2.converter.gson.GsonConverterFactory;

public class SendMessages extends AppCompatActivity {

    Button submitButton;
    RadioGroup radioBtns;
    RadioButton radioButton;
    EditText inputText;

    private SendQuestionService sendQuestionService;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_send_messages);
        radioBtns = (RadioGroup)findViewById(R.id.radioGroup);
        submitButton = (Button)findViewById(R.id.SubmitButton);
        submitButton.setOnClickListener(new View.OnClickListener(){

        String sessionId_String = getIntent().getStringExtra("EXTRA_SESSION_ID");

            @Override
            public void onClick(View view){

                //Intent intent = new Intent(getBaseContext(), Messages.class);
                //intent.putExtra("EXTRA_SESSION_ID", userId);
                //startActivity(intent);
                SendMessages(sessionId_String);
            }


        });
    }
    public void SendMessages(String sessionId){
        int selectedBtnId = radioBtns.getCheckedRadioButtonId();

        inputText = (EditText) findViewById(R.id.inputText);
        String inputText_String = inputText.getText().toString();

        radioButton = (RadioButton) findViewById(selectedBtnId);
        String inputSubject = (String) radioButton.getText();



        Retrofit retrofit = new Retrofit.Builder()
                .addCallAdapterFactory(RxJava2CallAdapterFactory.create())
                .addConverterFactory(GsonConverterFactory.create())
                .baseUrl("http://158.39.188.201/steg2/prosjektoppgave_Datasikkerhet/api/")
                .build();

        sendQuestionService = retrofit.create(SendQuestionService.class);


        Call<Void> call = sendQuestionService.sendQuestion(sessionId, inputSubject, inputText_String);

        call.enqueue(new Callback<Void>() {
            @Override
            public void onResponse(Call<Void> call, retrofit2.Response<Void> response) {
                if (!response.isSuccessful()) {
                    Log.d("OnResponse", String.valueOf(response.code()));
                    return;
                }

                Intent intent = new Intent(getBaseContext(), Messages.class);
                intent.putExtra("EXTRA_SESSION_ID", sessionId);
                startActivity(intent);
            }

            @Override
            public void onFailure(Call<Void> call, Throwable t) {
                Log.d("Debug", String.valueOf(t.getMessage()));
            }
        });
    }
}