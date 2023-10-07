import {Link} from "@inertiajs/react";
import {Button} from "@/Components/ui/button";
import {PaginationLinks} from "@/types";


export default function Pagination({pages, numRecords, totalRecords}: {
    pages: PaginationLinks[],
    numRecords: number,
    totalRecords: number,
}) {
    return (
        <div className="flex items-center justify-end space-x-2 py-4 px-4">
            {/*<span>*/}
            {/*    Showing {numRecords} of {totalRecords}*/}
            {/*</span>*/}

            {pages.map(
                value =>
                    <Link href={value.url ?? '#'} disabled={value.url != null} preserveScroll={true}>
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
    );
}
