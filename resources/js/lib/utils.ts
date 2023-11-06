import {type ClassValue, clsx} from "clsx"
import {twMerge} from "tailwind-merge"
import {ColumnDef, ColumnFiltersState} from "@tanstack/react-table";

export function cn(...inputs: ClassValue[]) {
    return twMerge(clsx(inputs))
}

export function getUrlParams() {
    const urlParams = new URLSearchParams(window.location.search);
    return Object.fromEntries(urlParams.entries());
}

export function getInitialFilters<TData, TValue>(columns: ColumnDef<TData, TValue>[]): ColumnFiltersState {
    const columnFilters: ColumnFiltersState = [];
    const params = getUrlParams();
    columns.forEach(value => {
        // @ts-ignore
        const key: string | undefined = value?.accessorKey;
        if (key != null) {
            columnFilters.push({id: key, value: params[key]});
        }
    });
    return columnFilters;
}


export function compileFiltersQuery<TData, TValue>(columns: ColumnDef<TData, TValue>[], filters: ColumnFiltersState) {
    const params = getUrlParams();
    const filterValues = Object.fromEntries(Object.entries(filters).map(([_, v]) => [v.id as string, v.value as string]));
    columns.forEach(value => {
        // @ts-ignore
        const key: string | undefined = value?.accessorKey;
        if (key != null && !filterValues.hasOwnProperty(key)) {
            delete params[key];
        }
    });

    return {
        ...params,
        ...filterValues,
    };
}
