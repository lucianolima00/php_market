import * as React from 'react';
import Box from '@mui/material/Box';
import {DataGrid, GridColDef, GridRowModesModel, GridRowsProp} from '@mui/x-data-grid';
import {useEffect, useState} from "react";
import {api} from "../../../services/api";
import {Link} from "react-router-dom";
import { Stack } from '@mui/material';


export default function ProductIndex() {
    interface Product {
        id: number;
        name: string;
        description: string;
        value: number;
    }

    const [products, setProducts] = useState<Product[]>([])

    useEffect(() => {
        api.get('/product').then(response => {
            setProducts(response.data as Array<Product>);
        })
    }, []);

    const columns: GridColDef<(typeof rows)[number]>[] = [
        { field: 'id', headerName: 'ID', width: 90 },
        {
            field: 'name',
            headerName: 'Nome',
            width: 150,
        },
        {
            field: 'description',
            headerName: 'Descrição',
            width: 150,
        },
        {
            field: 'value',
            headerName: 'Valor',
            width: 150,
        },
    ];

    const rows = products;

    function NoResultsOverlay() {
        return (
            <Stack height="100%" alignItems="center" justifyContent="center">
                No results in DataGrid
            </Stack>
        );
    }

    return (
        <div>
            <Link to={`/product/create`}>Adicionar</Link>
            <Box sx={{ height: 400, width: '100%' }}>
                <DataGrid
                    getRowId={(row: Product) => row.id}
                    rows={rows}
                    columns={columns}
                    initialState={{
                        pagination: {
                            paginationModel: {
                                pageSize: 5,
                            },
                        },
                    }}
                    slots={{noResultsOverlay: NoResultsOverlay}}
                    pageSizeOptions={[5]}
                    disableRowSelectionOnClick
                />
            </Box>
        </div>
    );
}