package com.softsecapp;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

public class Response {
    @SerializedName("0")
    @Expose
    private User bruker;

    public User getBruker() {
        return bruker;
    }
}