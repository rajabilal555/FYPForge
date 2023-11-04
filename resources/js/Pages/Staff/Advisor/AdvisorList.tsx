import AuthenticatedLayout from "@/Layouts/StaffAuthenticatedLayout";
import {Head, Link, router} from "@inertiajs/react";
import {Advisor, PageProps, PaginatedData} from "@/types";
import {ColumnDef} from "@tanstack/react-table";
import {DataTable} from "@/Components/ui/data-table";
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from "@/Components/ui/dropdown-menu";
import {Button} from "@/Components/ui/button";
import {EllipsisVerticalIcon} from "@heroicons/react/20/solid";
import {Card} from "@/Components/ui/card";

const columns: ColumnDef<Advisor>[] = [
    {
        accessorKey: "name",
        header: "Name",
    },
    {
        accessorKey: "email",
        header: "Email",
    },
    {
        id: "actions",
        header: "Actions",
        cell: ({row}) => {
            // const student = row.original
            return (
                <DropdownMenu>
                    <DropdownMenuTrigger asChild>
                        <Button variant="ghost" className="h-8 w-8 p-1">
                            <span className="sr-only">Open menu</span>
                            <EllipsisVerticalIcon/>
                        </Button>
                    </DropdownMenuTrigger>
                    <DropdownMenuContent align="end">
                        <DropdownMenuItem
                            onClick={() =>
                                router.get(
                                    route("staff.advisor.edit", {
                                        id: row.original.id,
                                    })
                                )
                            }
                        >
                            Edit
                        </DropdownMenuItem>
                        <DropdownMenuSeparator/>
                        <DropdownMenuItem>View </DropdownMenuItem>
                    </DropdownMenuContent>
                </DropdownMenu>
            );
        },
    },
];
export default function AdvisorList({
                                        auth,
                                        advisors,
                                    }: PageProps<{ advisors: PaginatedData<Advisor> }>) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Advisor List
                </h2>
            }
        >
            <Head title="Advisors"/>

            <Link href={route("staff.advisor.create")}>
                <Button>Create</Button>
            </Link>
            <Card className="mt-4">
                <DataTable columns={columns} paginatedData={advisors}/>
            </Card>
        </AuthenticatedLayout>
    );
}
