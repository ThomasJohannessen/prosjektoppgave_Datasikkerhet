package com.softsecapp;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

public class User {
    @SerializedName("BrukerID")
    @Expose
    private int brukerId;

    public int getBrukerId() {
        return brukerId;
    }
}
