import React from 'react';
import { BrowserRouter as Router, Route, Link } from 'react-router-dom';

import Landing from "../../pages/Landing";
import SaleIndex from "../../pages/Sale/Index";
import ProductIndex from "../../pages/Product/Index";

const Navbar = () => {
    return (
        <Router>
            <div>
                <nav>
                    <ul>
                        <li>
                            <Link to="/">Home</Link>
                        </li>
                        <li>
                            <Link to="/page">Page</Link>
                        </li>
                        <li>
                            <Link to="/product">Product</Link>
                        </li>
                    </ul>
                </nav>

                <Route path="/" element={<Landing/>} />
                <Route path="/page" element={<SaleIndex/>} />
                <Route path="/product" element={<ProductIndex/>} />
            </div>
        </Router>
    );
};

export default Navbar;