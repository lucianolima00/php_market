import * as React from 'react';
import Box from '@mui/material/Box';
import { DataGrid, GridColDef } from '@mui/x-data-grid';
import {useEffect, useState} from "react";
import {api} from "../../../services/api";


export default function SaleIndex() {
    interface Sale {
        id: number;
        subject: string;
        products: []
    }

    const [sales, setSales] = useState<Sale[]>([])


    useEffect(() => {
        api.get('/sale').then(response => {
            setSales(response.data as Array<Sale>);
        })
    }, []);
    //Simulate the api request, cors do not work with docker
    // useEffect(() => {
    //     setSales([
    //         {
    //             id: 1,
    //             subject: 'Test'
    //         }
    //     ] as Array<Sale>)
    // }, []);

    const columns: GridColDef<(typeof rows)[number]>[] = [
        { field: 'id', headerName: 'ID', width: 90 },
        {
            field: 'subject',
            headerName: 'Assunto',
            width: 150,
        },
    ];

    const rows = sales;

    return (
        <Box sx={{ height: 400, width: '100%' }}>
            <DataGrid
                rows={rows}
                columns={columns}
                initialState={{
                    pagination: {
                        paginationModel: {
                            pageSize: 5,
                        },
                    },
                }}
                pageSizeOptions={[5]}
                checkboxSelection
                disableRowSelectionOnClick
            />
        </Box>
    );
}