import React from "react";
import ReactDOM from "react-dom";
import App from "./App";
import reportWebVitals from "./reportWebVitals";
import AuthProvider from './context/AuthProvider';

ReactDOM.render(
  <React.StrictMode>
      <AuthProvider>
        <App />
      </AuthProvider>
  </React.StrictMode>,
  document.getElementById("root")
);

reportWebVitals();
