package com.softsecapp;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

public class Response {
    @SerializedName("BrukerID")
    @Expose
    private String brukerId;

    public String getBrukerId() {
        return brukerId;
    }

}