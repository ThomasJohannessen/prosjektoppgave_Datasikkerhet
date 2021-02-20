package com.softsecapp;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

import java.util.ArrayList;

public class GetMessages {

    @SerializedName("message")
    @Expose
    private ArrayList<Answer> answer;

    public ArrayList<Answer> getAnswer() {
        return answer;
    }
}
