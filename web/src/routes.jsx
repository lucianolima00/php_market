import {
    createBrowserRouter,
} from "react-router-dom";

import Landing from "./pages/Landing/index.tsx";
import SaleIndex from "./pages/Sale/Index";
import ProductIndex from "./pages/Product/Index";

const Routes = createBrowserRouter([
        {
            path: "/",
            exact: true,
            element: <Landing/>
        },
        {
            path: "/sale",
            element: <SaleIndex/>
        },
        {
            path: "/product",
            element: <ProductIndex/>
        },
    ]
);

export default Routes;