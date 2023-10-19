import AuthenticatedLayout from "@/Layouts/StaffAuthenticatedLayout";
import {Head, Link, router} from "@inertiajs/react";
import {PageProps, PaginatedData, Project} from "@/types";
import {ColumnDef} from "@tanstack/react-table";
import {DataTable} from "@/Components/ui/data-table";
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from "@/Components/ui/dropdown-menu";
import {Button} from "@/Components/ui/button";
import {EllipsisVerticalIcon} from "@heroicons/react/20/solid";
import {Card} from "@/Components/ui/card";

const columns: ColumnDef<Project>[] = [
    {
        accessorKey: "id",
        header: "ID",
    },
    {
        accessorKey: "name",
        header: "Name",
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
                                    route("model.edit", {
                                        id: row.original.id,
                                    })
                                )
                            }
                        >
                            Edit
                        </DropdownMenuItem>
                        <DropdownMenuSeparator/>
                        <DropdownMenuItem
                            onClick={() =>
                                router.get(
                                    route("model.view", {
                                        id: row.original.id,
                                    })
                                )
                            }
                        >
                            View
                        </DropdownMenuItem>
                    </DropdownMenuContent>
                </DropdownMenu>
            );
        },
    },
];
export default function ProjectList({
                                        auth,
                                        data,
                                    }: PageProps<{ data: PaginatedData<Project> }>) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    All Projects
                </h2>
            }
        >
            <Head title="Projects List"/>

            <Link href={route(" create")}>
                <Button>Create</Button>
            </Link>
            <Card className="mt-4">
                <DataTable columns={columns} paginatedData={data}/>
            </Card>
        </AuthenticatedLayout>
    );
}
