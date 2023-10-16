import AuthenticatedLayout from "@/Layouts/StudentAuthenticatedLayout";
import {Head} from "@inertiajs/react";
import {PageProps} from "@/types";
import {Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle} from "@/Components/ui/card";
import {Alert, AlertDescription, AlertTitle} from "@/Components/ui/alert";
import {
    AvatarIcon,
    ChevronRightIcon,
    DashboardIcon,
    DotsHorizontalIcon,
    DownloadIcon,
    UploadIcon
} from "@radix-ui/react-icons";
import {
    ListTile,
    ListTileContent,
    ListTileDescription,
    ListTileLeading,
    ListTileTitle,
    ListTileTrailing
} from "@/Components/list-tile";
import {Button} from "@/Components/ui/button";
import {Avatar, AvatarFallback} from "@/Components/ui/avatar";
import {PlusIcon} from "@heroicons/react/24/solid";

export default function Dashboard({auth}: PageProps) {
    const members = [
        {
            id: 1,
            avatar: "JD",
            name: "John Doe",
        },
        {
            id: 2,
            avatar: "JS",
            name: "John Smith (YOU)",
        }
    ];
    const files = [
        {
            id: 1,
            name: "SRS Zabdesk.pdf",
        },
        {
            id: 2,
            name: "System Flow Diagram.jpg",
        }
    ]
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    View Project | Zabdesk
                </h2>
            }
        >
            <Head title="Viewing Project | Zabdesk"/>

            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                <Card className="md:col-span-2">
                    <CardHeader>
                        <CardTitle>Zabdesk</CardTitle>
                        <CardDescription>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas rhoncus, ligula sed
                            semper consectetur, purus enim cursus justo, et pretium neque nunc vitae lacus. Nam sit amet
                            elementum libero, eu posuere lorem. Pellentesque felis ex, varius ac commodo sed, ornare
                            et lectus. Proin eget velit a metus porttitor pretium. Quisque sollicitudin nisl justo, et
                            pharetra ligula semper sit amet. Morbi vel risus eu magna lobortis congue facilisis at
                            arcu.
                            Nullam auctor massa id sagittis sodales. Curabitur ultricies arcu sed nunc tincidunt,
                            quis convallis magna interdum. Donec ac nunc posuere, auctor leo id, pulvinar lorem. Orci
                            varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
                        </CardDescription>
                    </CardHeader>
                </Card>
                <div className="space-y-4">
                    <Card>
                        <CardHeader>
                            <CardTitle>Advisor</CardTitle>
                            {/*<CardDescription>Ali Mobin</CardDescription>*/}
                        </CardHeader>
                        <CardContent>
                            <ListTile>
                                <ListTileLeading>
                                    <Avatar>
                                        {/*<AvatarImage src="https://github.com/shadcn.png" />*/}
                                        <AvatarFallback>AM</AvatarFallback>
                                    </Avatar>
                                </ListTileLeading>
                                <ListTileContent>
                                    <ListTileTitle>Ali Mobin</ListTileTitle>
                                    {/*<ListTileDescription>*/}
                                    {/*    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas rhoncus,*/}
                                    {/*    ligula*/}
                                    {/*</ListTileDescription>*/}
                                </ListTileContent>
                                <ListTileTrailing>
                                    <Button variant="outline" size="icon">
                                        <DotsHorizontalIcon className="h-4 w-4"/>
                                    </Button>
                                </ListTileTrailing>
                            </ListTile>
                        </CardContent>
                    </Card>
                    <Card>
                        <CardHeader>
                            <CardTitle>Group Members</CardTitle>
                            <CardDescription>Your teammates</CardDescription>
                        </CardHeader>
                        <CardContent>
                            <div className="space-y-2">
                                {members.map((member) => (
                                    <ListTile key={member.id}>
                                        <ListTileLeading>
                                            <Avatar>
                                                {/*<AvatarImage src="https://github.com/shadcn.png" />*/}
                                                <AvatarFallback>JD</AvatarFallback>
                                            </Avatar>
                                        </ListTileLeading>
                                        <ListTileContent>
                                            <ListTileTitle>John Doe</ListTileTitle>
                                            {/*<ListTileDescription>*/}
                                            {/*    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas rhoncus,*/}
                                            {/*    ligula*/}
                                            {/*</ListTileDescription>*/}
                                        </ListTileContent>
                                        <ListTileTrailing>
                                            <Button variant="outline" size="icon">
                                                <DotsHorizontalIcon className="h-4 w-4"/>
                                            </Button>
                                        </ListTileTrailing>
                                    </ListTile>
                                ))}
                            </div>
                        </CardContent>
                        <CardFooter className="flex justify-stretch">
                            <Button variant="ghost" className="w-full">
                                <PlusIcon className='mr-1 w-4 h-4'/> Invite
                            </Button>
                        </CardFooter>
                    </Card>
                </div>
                <div className="space-y-4">
                    <Card>
                        <CardHeader>
                            <CardTitle>Files</CardTitle>
                            <CardDescription>Upload your SRS/SDS Documents here</CardDescription>
                        </CardHeader>
                        <CardContent>
                            <div className="space-y-2">
                                {files.map((member) => (
                                    <ListTile key={member.id}>
                                        <ListTileContent>
                                            <ListTileTitle>{member.name}</ListTileTitle>
                                            <ListTileDescription>
                                                <Button variant="link" className="">preview</Button>
                                            </ListTileDescription>
                                        </ListTileContent>
                                        <ListTileTrailing>
                                            <Button variant="outline" size="icon">
                                                <DownloadIcon className="h-4 w-4"/>
                                            </Button>
                                            <Button variant="outline" size="icon">
                                                <DotsHorizontalIcon className="h-4 w-4"/>
                                            </Button>
                                        </ListTileTrailing>
                                    </ListTile>
                                ))}
                            </div>
                        </CardContent>
                        <CardFooter>
                            <Button variant="ghost" className="w-full">
                                <UploadIcon className='mr-1 w-4 h-4'/> Upload
                            </Button>
                        </CardFooter>
                    </Card>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
