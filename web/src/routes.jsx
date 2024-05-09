import {
    createBrowserRouter,
} from "react-router-dom";

import Landing from "./pages/Landing/index.tsx";
import SaleIndex from "./pages/Sale/Index";

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
    ]

    /*createRoutesFromElements(
        <Route element={Landing} path="/" exact>
            {/!* Sale *!/}
            <Route element={SaleIndex} path="/sale">
                {/!*<Route element={SaleView} path="/sale/:id"/>*!/}
                {/!*<Route element={SaleCreate} path="/sale/create"/>*!/}
                {/!*<Route element={SaleUpdate} path="/sale/:id/update"/>*!/}
            </Route>
            {/!* Sale *!/}

            {/!* Product *!/}
            {/!*<Route element={ProductIndex} path="/product"/>*!/}
            {/!*<Route element={ProductView} path="/product/:id"/>*!/}
            {/!*<Route element={ProductCreate} path="/product/create"/>*!/}
            {/!*<Route element={ProductUpdate} path="/product/:id/update"/>*!/}
            {/!*!/!* Product *!/!*!/}

            {/!*!/!* ProductType *!/!*!/}
            {/!*<Route element={ProductTypeIndex} path="/product-type"/>*!/}
            {/!*<Route element={ProductTypeView} path="/product-type/:id"/>*!/}
            {/!*<Route element={ProductTypeCreate} path="/product-type/create"/>*!/}
            {/!*<Route element={ProductTypeUpdate} path="/product-type/:id/update"/>*!/}
            {/!* ProductType *!/}
        </Route>
    )*/
);

export default Routes;