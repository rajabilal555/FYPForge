import AuthenticatedLayout from "@/Layouts/StaffAuthenticatedLayout";
import {Head, useForm as ijsForm} from "@inertiajs/react";
import {PageProps, Student, User} from "@/types";
import {Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle} from "@/Components/ui/card";
import {useForm} from "react-hook-form"

import Zod from "zod"
import {zodResolver} from "@hookform/resolvers/zod";
import {Form, FormControl, FormDescription, FormField, FormItem, FormLabel, FormMessage} from "@/Components/ui/form";
import {Button} from "@/Components/ui/button";
import {Input} from "@/Components/ui/input";

const formSchema = Zod.object({
    name: Zod.string().min(2).max(30),
    email: Zod.string().email().min(2).max(30),
    registration_no: Zod.string().min(3),
    password: Zod.string().min(2),
})

export default function List({auth}: PageProps) {

    const {data, setData, post, processing, errors} = ijsForm({
        //
    });


    const form = useForm<Zod.infer<typeof formSchema>>({
        resolver: zodResolver(formSchema),
        defaultValues: {
            name: '',
            email: '',
            registration_no: '',
            password: '',
        },
    })

    function onSubmit(values: Zod.infer<typeof formSchema>) {
        // ✅ This will be type-safe and validated.
        setData(values);
        console.log(values);
        console.log(data);
        post(route('staff.student.store'))
    }

    return (
        <AuthenticatedLayout user={auth.user}
                             header={
                                 <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                                     Create Student
                                 </h2>
                             }
        >
            <Head title="Create Students"/>
            <Card>
                <CardHeader>
                    <CardTitle>New Student</CardTitle>
                </CardHeader>
                <CardContent>
                    <Form {...form}>
                        <form onSubmit={form.handleSubmit(onSubmit)} className="space-y-8">
                            <FormField
                                control={form.control}
                                name="registration_no"
                                render={({field}) => (
                                    <FormItem>
                                        <FormLabel>Reg no</FormLabel>
                                        <FormControl>
                                            <Input type='number' placeholder="20xxxxx" {...field} />
                                        </FormControl>
                                        <FormDescription>
                                            This is your public display name.
                                        </FormDescription>
                                        <FormMessage/>
                                    </FormItem>
                                )}
                            />
                            <FormField
                                control={form.control}
                                name="name"
                                render={({field}) => (
                                    <FormItem>
                                        <FormLabel>Name</FormLabel>
                                        <FormControl>
                                            <Input placeholder="Name" {...field} />
                                        </FormControl>
                                        <FormDescription>
                                            This is your public display name.
                                        </FormDescription>
                                        <FormMessage/>
                                    </FormItem>
                                )}
                            />

                            <FormField
                                control={form.control}
                                name="email"
                                render={({field}) => (
                                    <FormItem>
                                        <FormLabel>Email</FormLabel>
                                        <FormControl>
                                            <Input placeholder="forge@gmail.com" {...field} />
                                        </FormControl>
                                        <FormDescription>
                                            This is your public display name.
                                        </FormDescription>
                                        <FormMessage/>
                                    </FormItem>
                                )}
                            />

                            <FormField
                                control={form.control}
                                name="password"
                                render={({field}) => (
                                    <FormItem>
                                        <FormLabel>Password</FormLabel>
                                        <FormControl>
                                            <Input {...field} />
                                        </FormControl>
                                        <FormDescription>
                                            This is your public display name.
                                        </FormDescription>
                                        <FormMessage/>
                                    </FormItem>
                                )}
                            />
                            <Button type="submit">Submit</Button>
                        </form>
                    </Form>
                </CardContent>
            </Card>
        </AuthenticatedLayout>
    );
}
