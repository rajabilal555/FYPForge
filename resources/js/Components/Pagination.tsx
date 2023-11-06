import {Link, router} from "@inertiajs/react";
import {Button} from "@/Components/ui/button";
import {PaginationLinks} from "@/types";
import {Select, SelectContent, SelectItem, SelectTrigger, SelectValue} from "@/Components/ui/select";
import {getUrlParams} from "@/lib/utils";


export default function Pagination({pages, from, to, perPage, totalRecords}: {
    pages: PaginationLinks[],
    perPage: number,
    from: number,
    to: number,
    totalRecords: number,
}) {
    return (
        <div className="flex items-center justify-between space-x-2 py-4 px-4">
            <div className="flex items-center gap-1.5">
                <div className="flex items-center space-x-6 lg:space-x-8">
                    <div className="flex items-center space-x-2">
                        <p className="text-muted-foreground text-sm font-medium">Rows per page</p>
                        <Select
                            value={`${perPage}`}
                            onValueChange={(value) => {
                                console.log(value);
                                router.get(route(route().current() + ''),
                                    {...getUrlParams(), per_page: value,},
                                    {
                                        replace: true,
                                        preserveScroll: true,
                                    });
                            }}
                        >
                            <SelectTrigger className="h-8 w-[70px]">
                                <SelectValue placeholder={perPage}/>
                            </SelectTrigger>
                            <SelectContent side="top">
                                {[10, 20, 30, 40, 50].map((pageSize) => (
                                    <SelectItem key={pageSize} value={`${pageSize}`}>
                                        {pageSize}
                                    </SelectItem>
                                ))}
                            </SelectContent>
                        </Select>
                    </div>
                </div>
                <div className="text-muted-foreground text-sm font-medium">
                    Showing {from} to {to} of {totalRecords}
                </div>
            </div>
            <div className="flex items-center justify-space-between space-x-2  px-2">
                {pages.map(
                    (value, i) =>
                        <Link key={i} href={value.url ?? '#'} disabled={value.url != null} preserveScroll={true}>
                            <Button
                                key={value.label}
                                variant={value.active ? "outline" : "outline"}
                                size="sm"
                                className={value.active ? "bg-muted" : ""}

                                disabled={value.url == null || value.active}
                            >
                                <span dangerouslySetInnerHTML={{__html: value.label}}></span>
                            </Button>
                        </Link>
                )}
            </div>
        </div>
    );
}
