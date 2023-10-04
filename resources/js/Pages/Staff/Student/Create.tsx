import AuthenticatedLayout from "@/Layouts/StaffAuthenticatedLayout";
import {Head} from "@inertiajs/react";
import {PageProps, Student} from "@/types";
import {Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle} from "@/Components/ui/card";

export default function List({auth, students}: PageProps<{ students: Student[] }>) {
    return (
        <AuthenticatedLayout user={auth.user}
                             header={
                                 <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                                     Create Student
                                 </h2>
                             }
        >
            <Head title="Students List"/>
            <Card>
                <CardHeader>
                    <CardTitle>Card Title</CardTitle>
                    <CardDescription>Card Description</CardDescription>
                </CardHeader>
                <CardContent>
                    <p>Card Content</p>
                </CardContent>
                <CardFooter>
                    <p>Card Footer</p>
                </CardFooter>
            </Card>
        </AuthenticatedLayout>
    );
}
