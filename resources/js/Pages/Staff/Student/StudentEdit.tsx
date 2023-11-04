import AuthenticatedLayout from "@/Layouts/StaffAuthenticatedLayout";
import {Head, useForm} from "@inertiajs/react";
import {PageProps, Student} from "@/types";
import {Card, CardContent, CardHeader, CardTitle} from "@/Components/ui/card";

import {Button} from "@/Components/ui/button";
import {Input} from "@/Components/ui/input";
import {Label} from "@/Components/ui/label";
import {ChangeEvent} from "react";
import InputError from "@/Components/InputError";


export default function StudentEdit({auth, student}: PageProps<{ student: Student }>) {

    const {data, setData, put, processing, errors} = useForm({
        registration_no: student.registration_no,
        email: student.email,
        name: student.name,
        password: '',
    });


    function handleSubmit(e: ChangeEvent<HTMLFormElement>) {
        e.preventDefault()
        // post('/login')
        console.log(data);
        put(route('staff.student.update', {student: student.id}));
    }


    return (
        <AuthenticatedLayout user={auth.user}
                             header={
                                 <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                                     Edit Student
                                 </h2>
                             }
        >
            <Head title="Edit Student"/>
            <Card>
                <CardHeader>
                    <CardTitle>Editing {student.name}</CardTitle>
                </CardHeader>
                <CardContent>
                    <form onSubmit={handleSubmit} className="space-y-8">
                        <div className="grid w-full items-center gap-1.5">
                            <Label>Reg no</Label>
                            <Input disabled
                                   type='number' value={data.registration_no}
                                   onChange={e => setData('registration_no', e.target.value)}
                                   placeholder="20xxxxx"/>
                            <InputError message={errors.registration_no}/>
                        </div>
                        <div className="grid w-full items-center gap-1.5">
                            <Label>Name</Label>
                            <Input value={data.name} onChange={e => setData('name', e.target.value)}
                                   placeholder="Enter Name"/>
                            <InputError message={errors.name}/>
                        </div>

                        <div className="grid w-full items-center gap-1.5">
                            <Label>Email</Label>
                            <Input type="email" value={data.email} onChange={e => setData('email', e.target.value)}
                                   placeholder="forge@gmail.com"/>
                            <InputError message={errors.email}/>
                        </div>

                        <div className="grid w-full items-center gap-1.5">
                            <Label>Password</Label>
                            <Input type="password" onChange={e => setData('password', e.target.value)}
                                   placeholder="Unchanged"/>
                            <InputError message={errors.password}/>
                        </div>

                        <Button type="submit" disabled={processing}>Submit</Button>
                    </form>
                </CardContent>
            </Card>
        </AuthenticatedLayout>
    );
}
