import AuthenticatedLayout from "@/Layouts/StaffAuthenticatedLayout";
import {Head, useForm} from "@inertiajs/react";
import {PageProps, Project } from "@/types";
import {Card, CardContent, CardHeader, CardTitle} from "@/Components/ui/card";

import {Button} from "@/Components/ui/button";
import {Input} from "@/Components/ui/input";
import {Label} from "@/Components/ui/label";
import {ChangeEvent} from "react";
import InputError from "@/Components/InputError";


export default function List({auth, model}: PageProps<{ model:Project}>) {

    const {data, setData, post, processing, errors} = useForm({
        name: '',
        //  Add more fields
    });


    function handleSubmit(e: ChangeEvent<HTMLFormElement>) {
        e.preventDefault()
        console.log(data);
        post(route('model.update', model.id))
    }


    return (
        <AuthenticatedLayout user={auth.user}
                             header={
                                 <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                                     Edit Project
                                 </h2>
                             }
        >
            <Head title="Editing Project"/>
            <Card>
                <CardHeader>
                    <CardTitle>Update Project</CardTitle>
                </CardHeader>
                <CardContent>
                    <form onSubmit={handleSubmit} className="space-y-8">

                        <div className="grid w-full max-w-sm items-center gap-1.5">
                            <Label>Name</Label>
                            <Input value={data.name} onChange={e => setData('name', e.target.value)}
                                   placeholder="Enter Name"/>
                            <InputError message={errors.name}/>
                        </div>

                        {/*Add more fields*/}

                        <Button type="submit" disabled={processing}>Submit</Button>
                    </form>
                </CardContent>
            </Card>
        </AuthenticatedLayout>
    );
}
