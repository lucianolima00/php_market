import * as React from 'react';
import Box from '@mui/material/Box';
import {DataGrid, GridColDef, GridRowModesModel, GridRowsProp} from '@mui/x-data-grid';
import {useEffect, useState} from "react";
import {api} from "../../../services/api";
import {Link} from "react-router-dom";
import { Stack } from '@mui/material';


export default function ProductTypeIndex() {
    interface ProductType {
        id: number;
        name: string;
        tax: number;
    }

    const [productTypes, setProductTypes] = useState<ProductType[]>([])

    useEffect(() => {
        api.get('/product-type').then(response => {
            setProductTypes(response.data as Array<ProductType>);
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
            field: 'tax',
            headerName: 'Imposto',
            width: 150,
        },
    ];

    const rows = productTypes;

    function NoResultsOverlay() {
        return (
            <Stack height="100%" alignItems="center" justifyContent="center">
                No results in DataGrid
            </Stack>
        );
    }

    return (
        <div>
            <Link to={`/product-type/create`}>Adicionar</Link>
            <Box sx={{ height: 400, width: '100%' }}>
                <DataGrid
                    getRowId={(row: ProductType) => row.id}
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