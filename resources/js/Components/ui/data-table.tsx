import {
    ColumnDef,
    flexRender,
    getCoreRowModel,
    getPaginationRowModel,
    useReactTable,
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


    const table = useReactTable({
        data: (data ?? (paginatedData!.data)) as TData[],
        columns,
        getCoreRowModel: getCoreRowModel(),
        getPaginationRowModel: getPaginationRowModel(),
    });

    return (
        <div>
            <div className="rounded-md border">
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

            {paginatedData != undefined && <Pagination pages={paginatedData!.links} numRecords={paginatedData.per_page}
                                                       totalRecords={paginatedData.total}/>}
        </div>
    );
}
