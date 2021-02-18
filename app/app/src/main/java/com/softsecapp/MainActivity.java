package com.softsecapp;

import androidx.annotation.RequiresApi;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Build;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Retrofit;
import retrofit2.adapter.rxjava2.RxJava2CallAdapterFactory;
import retrofit2.converter.gson.GsonConverterFactory;

public class MainActivity extends AppCompatActivity {

    Button login_btn;
    EditText epost;
    EditText passord;
    TextView feilmelding;
    String epost_String;
    String passord_String;

    private LogInService logInService;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        login_btn=(Button)findViewById(R.id.login_button);
        login_btn.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View view){
                        //logIn();
                String userId = "11";
                Intent intent = new Intent(getBaseContext(), Messages.class);
                intent.putExtra("EXTRA_SESSION_ID", userId);
                startActivity(intent);
            }
        });
    }

   public void logIn(){

       epost = findViewById(R.id.epost_input);
       epost_String = epost.getText().toString();

       passord = findViewById(R.id.password_input);
       passord_String = passord.getText().toString();

       feilmelding = findViewById(R.id.feilmeldingsBoks);

       Retrofit retrofit = new Retrofit.Builder()
               .addCallAdapterFactory(RxJava2CallAdapterFactory.create())
               .addConverterFactory(GsonConverterFactory.create())
               .baseUrl("http://158.39.188.201/steg2/prosjektoppgave_Datasikkerhet/api/")
               .build();

       logInService = retrofit.create(LogInService.class);

       Call<Response> call = logInService.getlogin(epost_String, passord_String);

       call.enqueue(new Callback<com.softsecapp.Response>() {
           @Override
           public void onResponse(Call<Response> call, retrofit2.Response<Response> response) {
               if (!response.isSuccessful()) {
                   feilmelding.setText("Code: " + response.code());
                   Log.d("OnResponse", String.valueOf(response.code()));
                   return;
               }
               String userId = response.body().getBrukerId();

               feilmelding.setText(userId);

               Intent intent = new Intent(getBaseContext(), Messages.class);
               intent.putExtra("EXTRA_SESSION_ID", userId);
               startActivity(intent);
           }

           @Override
           public void onFailure(Call<Response> call, Throwable t) {
               feilmelding.setText("Feil innloggingsinformasjon.");
               Log.d("Debug", String.valueOf(t.getMessage()));
           }

       });
   }
}