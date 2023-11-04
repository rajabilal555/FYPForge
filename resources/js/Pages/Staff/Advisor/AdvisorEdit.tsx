import AuthenticatedLayout from "@/Layouts/StaffAuthenticatedLayout";
import {Head, useForm} from "@inertiajs/react";
import {Advisor, PageProps} from "@/types";
import {Card, CardContent, CardHeader, CardTitle} from "@/Components/ui/card";

import {Button} from "@/Components/ui/button";
import {Input} from "@/Components/ui/input";
import {Label} from "@/Components/ui/label";
import {ChangeEvent} from "react";
import InputError from "@/Components/InputError";


export default function AdvisorEdit({auth, advisor}: PageProps<{
    advisor: Advisor
}>) {

    const {data, setData, put, processing, errors} = useForm({
        email: advisor.email,
        name: advisor.name,
        password: '',
    });


    function handleSubmit(e: ChangeEvent<HTMLFormElement>) {
        e.preventDefault()
        console.log(data);
        put(route('staff.advisor.update', {advisor: advisor.id}));
    }

    return (
        <AuthenticatedLayout user={auth.user}
                             header={
                                 <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                                     Edit Advisor
                                 </h2>
                             }
        >
            <Head title="Edit Advisor"/>
            <Card>
                <CardHeader>
                    <CardTitle> Editing {advisor.name} </CardTitle>
                </CardHeader>
                <CardContent>
                    <form onSubmit={handleSubmit} className="space-y-8">
                        <div className="grid w-full items-center gap-1.5">
                            <Label>Name</Label>
                            <Input value={data.name} onChange={e => setData('name', e.target.value)}
                                   placeholder="Enter Name"/>
                            <InputError message={errors.name}/>
                        </div>

                        <div className="grid w-full items-center gap-1.5">
                            <Label>Email</Label>
                            <Input type="email" value={data.email} onChange={e => setData('email', e.target.value)}
                                   placeholder="forge@szabist.pk"/>
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
