import {Link} from "@inertiajs/react";
import {Button} from "@/Components/ui/button";
import {PaginationLinks} from "@/types";


export default function Pagination({pages, numRecords, totalRecords}: {
    pages: PaginationLinks[],
    numRecords: number,
    totalRecords: number,
}) {
    return (
        <div className="flex items-center justify-between space-x-2 py-4 px-4">
            <div>
                Showing {numRecords} of {totalRecords}
            </div>

            <div className="flex items-center justify-space-between space-x-2  px-2">
                {pages.map(
                    (value, i) =>
                        <Link key={i} href={value.url ?? '#'} disabled={value.url != null} preserveScroll={true}>
                            <Button
                                key={value.label}
                                variant={value.active ? "secondary" : "outline"}
                                size="sm"
                                disabled={value.url == null}
                            >
                                <span dangerouslySetInnerHTML={{__html: value.label}}></span>
                            </Button>
                        </Link>
                )}
            </div>
        </div>
    );
}
