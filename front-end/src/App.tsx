import * as React from "react";
import { BrowserRouter as Router, Route, Switch } from 'react-router-dom';
import { useState } from 'react';
import {Link} from 'react-router-dom';
import Home from "./home";

/** App has one property: a number */
//this is where the actual app gets rendered
//below you'll see a list of the routes for the URL
export class App extends React.Component{

    /** render the component */
        render() {
            return (
                <Router>
                    <div className="App">
                        <div className="container">
                            <div className="hero">
                                <div className="content">
                                    <Switch>
                                        <Route exact path="/"component={Home}/> 
                                    </Switch>
                                </div>
                            </div>
                        </div>
                    </div>
                </Router>
            );
        }
}