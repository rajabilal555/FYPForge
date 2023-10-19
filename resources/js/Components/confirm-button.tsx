import {ButtonHTMLAttributes, MouseEventHandler, RefAttributes} from 'react';
import {Button, ButtonProps} from "@/Components/ui/button";
import {
    AlertDialog, AlertDialogAction, AlertDialogCancel,
    AlertDialogContent, AlertDialogDescription, AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
    AlertDialogTrigger
} from "@/Components/ui/alert-dialog";


type ConfirmButtonProps = {
    dialogTitle?: string,
    dialogDescription?: string,

    onConfirm: MouseEventHandler<HTMLButtonElement>,
    dialogActionText?: string,

};

export default function ConfirmButton({
                                          dialogTitle = 'Are you absolutely sure?',
                                          dialogDescription,
                                          onConfirm,
                                          dialogActionText = 'Confirm',
                                          children,
                                      }: ButtonProps & ConfirmButtonProps) {
    return (
        <AlertDialog>
            <AlertDialogTrigger asChild>
                {children}
            </AlertDialogTrigger>
            <AlertDialogContent>
                <AlertDialogHeader>
                    <AlertDialogTitle>{dialogTitle}</AlertDialogTitle>
                    <AlertDialogDescription>{dialogDescription ?? ''}</AlertDialogDescription>
                </AlertDialogHeader>
                <AlertDialogFooter>
                    <AlertDialogCancel>Cancel</AlertDialogCancel>
                    <AlertDialogAction onClick={onConfirm}>
                        {dialogActionText}
                    </AlertDialogAction>
                </AlertDialogFooter>
            </AlertDialogContent>
        </AlertDialog>
    );
}
