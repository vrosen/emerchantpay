import React, {useState, useEffect} from 'react';
import {loadState, saveState} from '../library/localStorage';
import axios from "axios"

export const AuthContext = React.createContext();

const AuthProvider = (props) => {

    const [loggedIn, setLoggedIn] = useState(false);
    const [admin, setAdmin] = useState(false);
    const [user, setUser] = useState({});

    useEffect(() => {
        let loggedInUser = loadState("user");

        if (loggedInUser) {
            setUser(loggedInUser);
            setLoggedIn(true);

            if (loggedInUser.admin == 1) {
                setAdmin(true)
            }

        } else {
            setLoggedIn(false);
        }
    }, []);

    const signIn = (params) => {
        axios.post('http://localhost:8000/api/v1/login', params)
            .then((response) => {
                if (response.data.user) {
                    saveState("user", response.data.user);
                    saveState("auth", true);
                    if (response.data.user.admin == true) {
                        saveState("admin", true);
                        setAdmin(true);
                    }
                    setLoggedIn(true);
                    window.location.pathname = "/";
                }
            })

    }

    return (
        <AuthContext.Provider
            value={{
                loggedIn,
                user,
                signIn,
                setLoggedIn,
                admin
            }}
        >
            <>{props.children}</>
        </AuthContext.Provider>
    );
};

export default AuthProvider;