import AuthenticatedLayout from "@/Layouts/StaffAuthenticatedLayout";
import {Head, router} from "@inertiajs/react";
import {PageProps, Student} from "@/types";
import {ColumnDef} from "@tanstack/react-table";
import {DataTable} from "@/Components/ui/data-table";
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel, DropdownMenuSeparator,
    DropdownMenuTrigger
} from "@/Components/ui/dropdown-menu";
import {Button} from "@/Components/ui/button";
import {EllipsisVerticalIcon} from "@heroicons/react/20/solid";

const columns: ColumnDef<Student>[] = [
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
                        <Button variant="ghost" className="h-8 w-8 p-0">
                            <span className="sr-only">Open menu</span>
                            <EllipsisVerticalIcon/>
                            {/*<MoreHorizontal className="h-4 w-4"/>*/}
                        </Button>
                    </DropdownMenuTrigger>
                    <DropdownMenuContent align="end">
                        <DropdownMenuLabel>Actions</DropdownMenuLabel>
                        <DropdownMenuItem

                            onClick={() => router.get(route('staff.student.edit', {id: row.original.id}))}
                        >
                            Copy payment ID
                        </DropdownMenuItem>
                        <DropdownMenuSeparator/>
                        <DropdownMenuItem>View customer</DropdownMenuItem>
                        <DropdownMenuItem>View payment details</DropdownMenuItem>
                    </DropdownMenuContent>
                </DropdownMenu>
            )
        },
    },
]
export default function List({auth, students}: PageProps<{ students: Student[] }>) {
    return (
        <AuthenticatedLayout user={auth.user}
                             header={
                                 <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                                     Student List
                                 </h2>
                             }
        >
            <Head title="Students List"/>
            <div className="container mx-auto py-10">
                <DataTable columns={columns} data={students}/>
            </div>
        </AuthenticatedLayout>
    );
}