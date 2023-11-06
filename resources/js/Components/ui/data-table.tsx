import {
    Column,
    Table as ReactTable,
    ColumnDef,
    flexRender,
    getCoreRowModel,
    useReactTable, ColumnFiltersState, ColumnFilter,
} from "@tanstack/react-table";

import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/Components/ui/table";
import Pagination from "@/Components/Pagination";
import {PaginatedData} from "@/types";
import {Input} from "@/Components/ui/input";
import DebouncedInput from "@/Components/DebouncedInput";
import {IconInput} from "@/Components/ui/icon-input";
import {SearchIcon} from "lucide-react";
import {router} from "@inertiajs/react";
import {compileFiltersQuery, getInitialFilters, getUrlParams} from "@/lib/utils";
import {useEffect, useState} from "react";
import {Button} from "@/Components/ui/button";

interface DataTablePropsWithData<TData, TValue> {
    columns: ColumnDef<TData, TValue>[];
    data: TData[];
    paginatedData?: never;
}

interface DataTablePropsWithPaginatedData<TData, TValue> {
    columns: ColumnDef<TData, TValue>[];
    data?: never;
    paginatedData: PaginatedData<TData>;
}


export function DataTable<TData, TValue>({
                                             columns,
                                             data,
                                             paginatedData,
                                         }: DataTablePropsWithData<TData, TValue> | DataTablePropsWithPaginatedData<TData, TValue>) {

    const [columnFilters, setColumnFilters] = useState<ColumnFiltersState>(getInitialFilters(columns));

    const table = useReactTable({
        data: (data ?? (paginatedData!.data)) as TData[],
        manualFiltering: true,
        manualPagination: true,
        columns,
        getCoreRowModel: getCoreRowModel(),
        state: {
            columnFilters: columnFilters,
        },
        onColumnFiltersChange: setColumnFilters,
        // debugTable: true,
        // debugHeaders: true,
        // debugColumns: true,
    });

    useEffect(() => {
        const params = getUrlParams();
        const compiled = compileFiltersQuery(columns, columnFilters);
        if (JSON.stringify(compiled) !== JSON.stringify(params)) {
            router.get(route(`${route().current()}`),
                compileFiltersQuery(columns, columnFilters),
                {
                    replace: true,
                    preserveScroll: true,
                });
        }
    }, [columnFilters])

    return (
        <div>
            <div className="p-4 rounded-md border">
                <div className="flex justify-between items-center mb-4">
                    <div className="w-1/4">
                        <IconInput icon={SearchIcon} className={"w-full"} placeholder="Search..."/>
                    </div>
                </div>
                <Table>
                    <TableHeader>
                        {table.getHeaderGroups().map((headerGroup) => (
                            <TableRow key={headerGroup.id}>
                                {headerGroup.headers.map((header) => {
                                    return (
                                        <TableHead key={header.id}>
                                            {header.isPlaceholder
                                                ? null
                                                : flexRender(
                                                    header.column.columnDef
                                                        .header,
                                                    header.getContext()
                                                )}
                                            {header.column.getCanFilter() ? (
                                                <div>
                                                    <Filter column={header.column} table={table}/>
                                                </div>
                                            ) : null}
                                        </TableHead>
                                    );
                                })}
                            </TableRow>
                        ))}
                    </TableHeader>
                    <TableBody>
                        {table.getRowModel().rows?.length ? (
                            table.getRowModel().rows.map((row) => (
                                <TableRow
                                    key={row.id}
                                    data-state={
                                        row.getIsSelected() && "selected"
                                    }
                                >
                                    {row.getVisibleCells().map((cell) => (
                                        <TableCell key={cell.id}>
                                            {flexRender(
                                                cell.column.columnDef.cell,
                                                cell.getContext()
                                            )}
                                        </TableCell>
                                    ))}
                                </TableRow>
                            ))
                        ) : (
                            <TableRow>
                                <TableCell
                                    colSpan={columns.length}
                                    className="h-24 text-center"
                                >
                                    No results.
                                </TableCell>
                            </TableRow>
                        )}
                    </TableBody>
                </Table>
            </div>

            {paginatedData != undefined &&
                <Pagination
                    pages={paginatedData!.links}
                    from={paginatedData.from}
                    to={paginatedData.to}
                    perPage={paginatedData.per_page}
                    totalRecords={paginatedData.total}/>}
        </div>
    );
}


function Filter({
                    column,
                    table,
                }: {
    column: Column<any, unknown>
    table: ReactTable<any>
}) {
    const firstValue = table
        .getPreFilteredRowModel()
        .flatRows[0]?.getValue(column.id)

    const columnFilterValue = column.getFilterValue()


    return typeof firstValue === 'number' ? (
        <div>
            <div className="flex space-x-2">
                <DebouncedInput
                    type="number"
                    value={(columnFilterValue as [number, number])?.[0] ?? ''}
                    onChange={value =>
                        column.setFilterValue((old: [number, number]) => [value, old?.[1]])
                    }
                    placeholder={`Min`}
                    className="w-24 border shadow rounded"
                />
                <DebouncedInput
                    type="number"
                    value={(columnFilterValue as [number, number])?.[1] ?? ''}
                    onChange={value =>
                        column.setFilterValue((old: [number, number]) => [old?.[0], value])
                    }
                    placeholder={`Max`}
                    className="w-24 border shadow rounded"
                />
            </div>
            <div className="h-1"/>
        </div>
    ) : (
        <>
            <DebouncedInput
                type="text"
                value={(columnFilterValue ?? '') as string}
                onChange={value => column.setFilterValue(value)}
                placeholder={`Search by ${column.columnDef.header}`}
                className="w-full"
            />
            <div className="h-1"/>
        </>
    )
}
